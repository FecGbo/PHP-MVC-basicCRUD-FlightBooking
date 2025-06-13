<?php
require_once 'models/traveller_abstract.php';
class traveller_controller
{
    private $traveller;

    public function __construct($db)
    {
        $this->traveller = new traveller_abstract($db);
    }

    public function index()
    {
        session_start();
        $results = $this->traveller->search([
            'airline' => $_GET['airline'] ?? '',
            'from_city' => $_GET['from_city'] ?? '',
            'to_city' => $_GET['to_city'] ?? '',
            'departure_time' => $_GET['departure_time'] ?? '',
            'days' => $_GET['days'] ?? ''
        ]);

        $traveler_id = $_SESSION['traveler_id'] ?? null;
        $notification = null;


        // if ($traveler_id) {

        //     if (empty($_SESSION['notification_shown'])) {
        //         $notification = $this->traveller->getNotification($traveler_id);
        //         if ($notification && !empty($notification['notification'])) {
        //             $_SESSION['flash_notification'] = $notification['notification'];
        //             $_SESSION['notification_shown'] = true;
        //             // $this->traveller->clearNotification($traveler_id);  
        //         }
        //     }
        // }
        if ($traveler_id) {
            $notification = $this->traveller->getNotification($traveler_id);
            if ($notification && !empty($notification['notification'])) {
                $_SESSION['flash_notification'] = $notification['notification'];
                $_SESSION['last_confirmation_number'] = $notification['confirmation_number'] ?? null;

                $this->traveller->clearNotification($traveler_id);
            } else {
                unset($_SESSION['flash_notification']);
            }
        }

        include 'views/index.php';
    }

    public function flight()
    {

        include 'views/flight.php';
    }

    public function rent_car()
    {

        include 'views/rent_car.php';
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->traveller->register($_POST);

            if ($result['success']) {
                header('Location: index.php');
                exit;
            }

            $errors = $result['errors'];
            $full_name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $contact_number = trim($_POST['contact_number'] ?? '');
            $created_at = trim($_POST['created_at'] ?? '');
            include 'views/traveller_reg.php';
        } else {
            $errors = [];
            $full_name = $email = $contact_number = $created_at = '';
            include 'views/traveller_reg.php';
        }
    }




    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->traveller->login($_POST);
            if ($result['success']) {
                header('Location: index.php');
                exit;
            }
            $errors = $result['errors'];
            $email = trim($_POST['email'] ?? '');
            include 'views/traveller_log.php';
        } else {
            $errors = [];
            $email = '';
            include 'views/traveller_log.php';
        }
    }
    public function traveller_logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        unset($_SESSION['notification_shown']);
        header("Location: index.php?action=traveller_log");
        exit();
    }


    public function search()
    {
        $results = [];
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
            $results = $this->traveller->search([
                'from_city' => $_GET['from_city'] ?? '',
                'to_city' => $_GET['to_city'] ?? '',
                'departure_date' => $_GET['departure_date'] ?? '',
                'days' => $_GET['days'] ?? '',
            ]);
        }
        include 'views/index.php';
    }



    public function book()
    {
        $traveler_id = $_POST['traveler_id'] ?? null;
        $flight_id = $_POST['flight_id'] ?? '';
        $traveler_email = '';


        if ($traveler_id) {
            $traveler_email = $this->traveller->getTravellerEmail($traveler_id);
        }


        if (!$traveler_id || !$traveler_email) {
            header("Location: index.php?action=login");
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flight_id']) && !isset($_POST['passenger_name'])) {
            if ($flight_id) {
                $flight = $this->traveller->getFlightById($flight_id);
            }
            include 'views/booking.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['passenger_name'])) {
            $data = [
                'traveler_id' => $traveler_id,
                'flight_id' => $_POST['flight_id'],
                'passenger_name' => $_POST['passenger_name'],
                'date_of_birth' => $_POST['date_of_birth'],
                'passport_number' => $_POST['passport_number'],
            ];

            if (empty($data['flight_id']) || empty($data['passenger_name']) || empty($data['date_of_birth'])) {
                $error = "Please fill in all required fields.";
                include 'views/booking.php';
                return;
            }

            // Save booking and get confirmation number
            $confirmation_number = $this->traveller->booking($data);

            $booking = $this->traveller->getBookingByConfirmation($confirmation_number);

            $flight = $this->traveller->getFlightById($booking['flight_id']);
            $amount = $flight['price'] ?? 0;
            $booking_id = $booking['booking_id'] ?? '';


            include 'views/payment.php';
            return;
        }

        header("Location: index.php");
        exit;
    }



    public function process_payment()
    {
        // Prevent direct access without booking info
        if (!isset($_POST['booking_id']) || !isset($_POST['amount'])) {
            header("Location: index.php");
            exit;
        }

        if (isset($_POST['cancel'])) {
            // User cancelled payment
            $paymentData = [
                'booking_id' => $_POST['booking_id'],
                'amount' => $_POST['amount'],
                'payment_method' => $_POST['payment_method'] ?? '',
                'payment_status' => 'Failed'
            ];
            $this->traveller->savePayment($paymentData);
            $this->traveller->deletePyamentsByBookingId($_POST['booking_id']);
            $this->traveller->deleteBooking($_POST['booking_id']);
            header("Location: index.php");
            exit;
        }

        if (isset($_POST['pay'])) {
            // User completed payment
            $paymentData = [
                'booking_id' => $_POST['booking_id'],
                'amount' => $_POST['amount'],
                'payment_method' => $_POST['payment_method'],
                'payment_status' => 'Completed'
            ];
            $this->traveller->savePayment($paymentData);

            $booking = $this->traveller->getBookingById($_POST['booking_id']);

            include 'views/booking_confirm.php';
            return;
        }

        // Fallback
        header("Location: index.php");
        exit;
    }

    public function search_ticket_status()
    {
        $booking = null;
        $searched = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmation_number'])) {
            $searched = true;
            $confirmation_number = trim($_POST['confirmation_number']);
            $booking = $this->traveller->searchByConfirmationNumber($confirmation_number);
        }

        include 'views/search_ticket.php';
    }


    public function flight_details()
    {
        $flight_id = $_GET['flight_id'] ?? null;
        if ($flight_id) {
            $flights = $this->traveller->getFiightDetails($flight_id);
            if (!$flights) {
                header("Location: index.php");
                exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }

        include 'views/flight.php';
    }

    public function airlines()
    {
        session_start();

        $airlines = $this->traveller->getAllAirline();
        include 'views/airline.php';
    }


    public function download_receipt()
    {
        if (isset($_GET['confirmation'])) {
            $confirmationNumber = $_GET['confirmation'];
            $booking = $this->traveller->searchByConfirmationNumber($confirmationNumber);
            if ($booking) {
                include 'views/download_receipt.php';
                exit;
            } else {
                echo "Booking not found.";
            }
        } else {
            echo "No confirmation number provided.";
        }
    }
}

?>