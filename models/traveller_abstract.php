<?php
require_once 'models/db_abstract.php';
require_once 'interfaces/traveller.php';

class traveller_abstract extends db_abstract implements traveller
{



    public function register($data): array
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return ['success' => false, 'errors' => ['method' => 'Invalid request method']];
        }

        $errors = [];

        $name = trim($data['full_name'] ?? '');
        if (empty($name)) {
            $errors['full_name'] = 'Full name is required';
        } elseif (!preg_match('/^[a-zA-Z\s]{2,50}$/', $name)) {
            $errors['full_name'] = 'Invalid name: Letters and spaces only, 2-50 characters';
        }

        $email = trim($data['email'] ?? '');
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        $password = trim($data['password'] ?? '');
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            $errors['password'] = 'Password must be 8+ characters with letters and numbers';
        }

        $contact_n = trim($data['contact_number'] ?? '');
        if (empty($contact_n)) {
            $errors['contact_number'] = 'Contact number is required';
        } elseif (!preg_match('/^\d{7,15}$/', $contact_n)) {
            $errors['contact_number'] = 'Invalid contact number: 7-15 digits';
        }

        $created_at = trim($data['created_at'] ?? '');
        if (empty($created_at)) {
            $errors['created_at'] = 'Creation date is required';
        } elseif (!DateTime::createFromFormat('Y-m-d\TH:i', $created_at)) {
            $errors['created_at'] = 'Invalid date format';
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }


        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $created_at_formatted = date('Y-m-d H:i:s', strtotime($created_at));

        try {
            $stmt = $this->db->prepare('INSERT INTO travelers (full_name, email, password, contact_number, created_at) VALUES (:full_name, :email, :password, :contact_number, :created_at)');
            $success = $stmt->execute([
                ':full_name' => $name,
                ':email' => $email,
                ':password' => $password_hashed,
                ':contact_number' => $contact_n,
                ':created_at' => $created_at_formatted
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                return ['success' => false, 'errors' => ['email' => 'This email is already registered.']];
            }
            return ['success' => false, 'errors' => ['database' => 'Failed to register user']];
        }


        return ['success' => true];
    }



    public function login($data)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($data['email']);
            $password = trim($data['password']);
            $remember = isset($data['remember']);

            $errors = [];

            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }

            if (!empty($errors)) {
                return ['success' => false, 'errors' => $errors];
            }

            $result = $this->db->prepare("SELECT traveler_id, full_name, email, password FROM travelers WHERE email = :email");
            $result->execute([':email' => $email]);
            $traveler = $result->fetch(PDO::FETCH_ASSOC);

            if ($traveler && password_verify($password, $traveler['password'])) {
                session_start();
                $_SESSION['traveller_name'] = $traveler['full_name'];
                $_SESSION['traveler_id'] = $traveler['traveler_id'];
                $_SESSION['traveler_email'] = $traveler['email'];


                return ['success' => true];
            } else {
                return ['success' => false, 'errors' => ['credentials' => 'Wrong email or password']];
            }
        }

        return ['success' => false, 'errors' => ['method' => 'Invalid request method']];
    }

    public function search($data)
    {
        $sql = "SELECT * FROM flights WHERE available_seats>0 AND departure_time >= :today";
        $condition = [];
        $params = [':today' => date('Y-m-d')];

        if (!empty($data['airline'])) {
            $condition[] = "airline LIKE :airline";
            $params[':airline'] = '%' . $data['airline'] . '%';
        }
        if (!empty($data['from_city'])) {
            $condition[] = "departure_city LIKE :from_city";
            $params[':from_city'] = '%' . $data['from_city'] . '%';
        }
        if (!empty($data['to_city'])) {
            $condition[] = "destination_city LIKE :to_city";
            $params[':to_city'] = '%' . $data['to_city'] . '%';
        }
        if (!empty($data['departure_time'])) {
            $condition[] = "DATE(departure_time) = :departure_time";
            $params[':departure_time'] = $data['departure_time'];
        }
        if (!empty($data['days'])) {
            $condition[] = "Days LIKE :days";
            $params[':days'] = '%' . $data['days'] . '%';
        }

        if ($condition) {
            $sql .= " AND " . implode(" AND ", $condition);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);



    }

    public function getTravellerEmail($traveler_id)
    {
        $stmt = $this->db->prepare("SELECT email FROM travelers WHERE traveler_id = :traveler_id");
        $stmt->execute([':traveler_id' => $traveler_id]);
        $traveler = $stmt->fetch(PDO::FETCH_ASSOC);
        return $traveler['email'] ?? '';
    }
    public function booking($data)
    {

        error_log("Booking data: " . print_r($data, true));

        // Validate required fields
        $required = ['traveler_id', 'flight_id', 'passenger_name', 'date_of_birth', 'passport_number'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                error_log("Booking error: Missing required field: $field");
                throw new Exception("Missing required field: $field");
            }
        }


        if (empty($data['confirmation_number'])) {
            $data['confirmation_number'] = strtoupper(bin2hex(random_bytes(4)));
        }

        $sql = "INSERT INTO bookings 
        (traveler_id, flight_id, passenger_name, date_of_birth, passport_number, booking_date, confirmation_number, status) 
        VALUES 
        (:traveler_id, :flight_id, :passenger_name, :date_of_birth, :passport_number, :booking_date, :confirmation_number, :status)";

        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                ':traveler_id' => $data['traveler_id'],
                ':flight_id' => $data['flight_id'],
                ':passenger_name' => $data['passenger_name'],
                ':date_of_birth' => $data['date_of_birth'],
                ':passport_number' => $data['passport_number'],
                ':booking_date' => date('Y-m-d H:i:s'),
                ':confirmation_number' => $data['confirmation_number'],
                ':status' => 'pending' 
            ]);
            error_log("Booking inserted successfully!");
        } catch (PDOException $e) {
            error_log("Booking insert error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }

        return $data['confirmation_number'];
    }


    public function getBookingByConfirmation($confirmation_number)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE confirmation_number = :confirmation_number");
        $stmt->execute([':confirmation_number' => $confirmation_number]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function savePayment($data)
    {
        $sql = "INSERT INTO payments
            (booking_id, amount, payment_method, payment_status, payment_date) 
            VALUES 
            (:booking_id, :amount, :payment_method, :payment_status, NOW())";

        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                ':booking_id' => $data['booking_id'],
                ':amount' => $data['amount'],
                ':payment_method' => $data['payment_method'],
                ':payment_status' => $data['payment_status']
            ]);
            error_log("Payment inserted successfully!");
        } catch (PDOException $e) {
            error_log("Payment insert error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public function getFlightById($flight_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM flights WHERE flight_id = :flight_id");
        $stmt->execute([':flight_id' => $flight_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getBookingById($booking_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE booking_id = :booking_id");
        $stmt->execute([':booking_id' => $booking_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function deleteBooking($booking_id)
    {
        $stmt = $this->db->prepare("DELETE FROM bookings WHERE booking_id = :booking_id");
        return $stmt->execute([':booking_id' => $booking_id]);


    }

    public function deletePyamentsByBookingId($booking_id)
    {

        $stmt = $this->db->prepare("DELETE FROM payments WHERE booking_id = :booking_id");
        $stmt->execute([':booking_id' => $booking_id]);

    }


    public function getNotification($traveller_id)
    {
        $stmt = $this->db->prepare("SELECT notification,confirmation_number FROM bookings WHERE traveler_id = :traveler_id AND notification IS NOT NULL ORDER BY booking_date DESC LIMIT 1");
        $stmt->execute([':traveler_id' => $traveller_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function clearNotification($traveller_id)
    {
        $stmt = $this->db->prepare("UPDATE bookings SET notification = NULL WHERE traveler_id = :traveller_id");
        $stmt->execute([':traveller_id' => $traveller_id]);
    }

    public function searchByConfirmationNumber($confirmationNumber)
    {
        $stmt = $this->db->prepare("
            SELECT 
                b.flight_id, b.passenger_name, b.booking_date, b.status,b.confirmation_number,
                f.airline, f.departure_city, f.destination_city, f.departure_time, f.arrival_time, f.days
            FROM bookings b
            JOIN flights f ON b.flight_id = f.flight_id
            WHERE b.confirmation_number = :confirmation_number
        ");
        $stmt->execute([':confirmation_number' => $confirmationNumber]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFiightDetails($flight_id)
    {
        $stmt = $this->db->prepare("
        SELECT 
            f.flight_id, f.airline, f.departure_city, f.destination_city, f.departure_time, 
            f.arrival_time, f.Days, f.price,
            fd.aircraft_type, fd.gate_number, fd.duration, fd.meal, 
            fd.in_flight_entertainment, fd.wifi_available, fd.notes, fd.image_url
        FROM flights f
        INNER JOIN flight_details fd ON f.flight_id = fd.flight_id
        WHERE f.flight_id = :flight_id
    ");
        $stmt->execute([':flight_id' => $flight_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    public function getAllAirline()
    {
        $stmt = $this->db->prepare("SELECT * FROM airlines");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>