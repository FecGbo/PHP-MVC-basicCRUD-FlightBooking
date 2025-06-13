<?php
require_once 'models/db_abstract.php';
require_once 'interfaces/admin.php';
class Admin_abstract extends db_abstract implements Admin
{



    public function getPendingBookings()
    {
        $stmt = $this->db->query("SELECT * FROM bookings where status='pending'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function approveBooking($id)
    {
        $stmt = $this->db->prepare("UPDATE bookings SET status='approved' where booking_id=:id");
        return $stmt->execute([':id' => $id]);
        // if ($success) {
        //     $this->setBookingNotification($id, "Your booking has been approved.");
        // }
        // return $success;

    }




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

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }


        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->db->prepare('INSERT INTO administrators (full_name, email, password) VALUES (:full_name, :email, :password)');
            $success = $stmt->execute([
                ':full_name' => $name,
                ':email' => $email,
                ':password' => $password_hashed

            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return ['success' => false, 'errors' => ['email' => 'This email is already registered.']];
            }
            return ['success' => false, 'errors' => ['database' => 'Failed to register user']];
        }


        return ['success' => true];

    }



    public function login($data)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($data['email']);
            $password = trim($data['password']);

            $stmt = $this->db->prepare("SELECT admin_id, full_name, email, password FROM administrators WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($password, $admin['password'])) {

                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_name'] = $admin['full_name'];
                return [
                    'id' => $admin['admin_id'],
                    'email' => $admin['email'],
                    'name' => $admin['full_name']
                ];
            }
            return false;
        }
    }

    public function getBookingById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE booking_id=:booking_id");
        $stmt->execute([':booking_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    public function decrementAvailableSeats($flightId)
    {
        $stmt = $this->db->prepare("UPDATE flights SET available_seats=available_seats-1 WHERE flight_id=:flight_id AND available_seats > 0");
        $stmt->execute([':flight_id' => $flightId]);
    }


    // Noti 
    public function setBookingNotification($booking_id, $message)
    {
        $stmt = $this->db->prepare("UPDATE bookings SET notification = :message WHERE booking_id = :booking_id");
        $stmt->execute([
            ':message' => $message,
            ':booking_id' => $booking_id
        ]);
    }


    //add flights

    public function addFlight($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $airline = trim($data['airline']);
            $airline_code = trim($data['airline_code'] ?? '');
            $airline_country = trim($data['airline_country'] ?? '');
            $dpt_city = trim($data['departure_city']);
            $dest_city = trim($data['destination_city']);
            $dpt_time = trim($data['departure_time']);
            $arr_time = trim($data['arrival_time']);
            $day = trim($data['day']);
            $price = trim($data['price']);
            $seat = trim($data['seat']);

            $logo_url = '';
            if (isset($_FILES['airline_logo']) && $_FILES['airline_logo']['error'] === UPLOAD_ERR_OK) {
                $originalName = basename($_FILES['airline_logo']['name']);
                $destination = 'images/' . $originalName;

                if (move_uploaded_file($_FILES['airline_logo']['tmp_name'], $destination)) {
                    $logo_url = $destination;
                } else {
                    $_SESSION['flash_message'] = "Logo upload failed!";
                }
            }


            $stmt = $this->db->prepare("SELECT COUNT(*) FROM airlines WHERE LOWER(name) = LOWER(:name)");
            $stmt->execute([':name' => $airline]);
            if (!$stmt->fetchColumn()) {
                $stmt = $this->db->prepare("INSERT INTO airlines (name, code, country, logo_url) VALUES (:name, :code, :country, :logo_url)");
                $stmt->execute([
                    ':name' => $airline,
                    ':code' => $airline_code,
                    ':country' => $airline_country,
                    ':logo_url' => $logo_url
                ]);
            }


            $stmt = $this->db->prepare("INSERT INTO flights (
                airline,
                departure_city,
                destination_city,
                departure_time,
                arrival_time,
                Days,
                price,
                available_seats
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            if (
                $stmt->execute([
                    $airline,
                    $dpt_city,
                    $dest_city,
                    $dpt_time,
                    $arr_time,
                    $day,
                    $price,
                    $seat
                ])
            ) {
                $_SESSION['flash_message'] = "Add Successfully!";
            } else {
                $_SESSION['flash_message'] = "Failed to add flight.";
            }
            header("Location:index.php?action=admin_add_flight.php");
        } else {
            $_SESSION['flash_message'] = "Invalid input";
        }
    }

    public function getFlight()
    {
        $stmt = $this->db->query("SELECT * FROM flights");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAirline()
    {
        $stmt = $this->db->prepare("SELECT name FROM airlines");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }


    public function addFlightDetails($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $flight_id = trim($data['flight_id'] ?? '');
            $aircraft_type = trim($data['aircraft_type'] ?? '');
            $gate_number = trim($data['gate_number'] ?? '');
            $duration = trim($data['duration'] ?? '');
            $meal = trim($data['meal'] ?? '');
            $in_flight_entertainment = trim($data['in_flight_entertainment'] ?? '');
            $wifi_available = trim($data['wifi_available'] ?? '');
            $notes = trim($data['notes'] ?? '');
            $image_url = trim($data['image_url'] ?? '');

            $stmt = $this->db->prepare("INSERT INTO flight_details 
                (flight_id, aircraft_type, gate_number, duration, meal, in_flight_entertainment, wifi_available, notes, image_url)
                VALUES
                (:flight_id, :aircraft_type, :gate_number, :duration, :meal, :in_flight_entertainment, :wifi_available, :notes, :image_url)");

            $success = $stmt->execute([
                ':flight_id' => $flight_id,
                ':aircraft_type' => $aircraft_type,
                ':gate_number' => $gate_number,
                ':duration' => $duration,
                ':meal' => $meal,
                ':in_flight_entertainment' => $in_flight_entertainment,
                ':wifi_available' => $wifi_available,
                ':notes' => $notes,
                ':image_url' => $image_url
            ]);

            if ($success) {
                $_SESSION['flash_message'] = "Flight details added successfully!";
            } else {
                $_SESSION['flash_message'] = "Failed to add flight details.";
            }
            header("Location: index.php?action=admin_edit_flight");
            exit;
        } else {
            $_SESSION['flash_message'] = "Invalid request.";
            header("Location: index.php?action=admin_edit_flight");
            exit;
        }
    }

}



?>