<?php

require_once 'models/admin_abstract.php';
// require_once 'models/traveller_abstract.php';

class admin_controller
{
    private $admin;

    public function __construct($admin)
    {
        $this->admin = $admin;
    }


    public function showPendingBookings()
    {
        $pending = $this->admin->getPendingBookings();
        include 'views/admin_views/admin_pending_bookings.php';
    }

    public function approveBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $this->admin->approveBooking($_POST['booking_id']);

            $this->admin->setBookingNotification($_POST['booking_id'], "Your booking has been approved.");

            //Decrease seats

            $booking = $this->admin->getBookingById($_POST['booking_id']);


            if ($booking && isset($booking['flight_id'])) {
                $flight_id = $booking['flight_id'];
                $this->admin->decrementAvailableSeats($flight_id);
            } else {

                echo "Booking or flight not found.";
                return;
            }

            header('Location: index.php?action=admin_pending_bookings');
            exit;
        }
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->admin->register($_POST);

            if ($result['success']) {
                header('Location: index.php');
                exit;
            }
            $errors = $result['errors'];
            $full_name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            include 'views/admin_views/admin_reg.php';

        } else {
            $errors = [];
            $full_name = $email = '';
            include 'views/admin_views/admin_reg.php';
        }
    }



    public function login()
    {
        // session_start();  

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->admin->login($_POST);
            if ($result !== false) {
                header('Location: index.php?action=admin_pending_bookings');
                exit();
            } else {
                $err = "Invalid email or password";
                include 'views/admin_views/admin_log.php';
            }
        } else {
            include 'views/admin_views/admin_log.php';
        }
    }


    public function add_flight()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->admin->addFlight($_POST);

            header("Location: index.php?action=admin_add_flight");
            exit;
        }
        // Fetch all airline names for JS in the view
        $allAirlines = $this->admin->getAirline();
        include 'views/admin_views/admin_add_flight.php';
    }

    public function get_flight()
    {
        session_start();

        $flights = $this->admin->getFlight();
        if ($flights) {
            include 'views/admin_views/admin_edit_flight.php';
        } else {
            echo "No flights available.";
        }
    }
    public function admin_add_flight_details()
    {
        session_start();
        $flight_id = $_GET['flight_id'] ?? '';
        include 'views/admin_views/admin_add_flight_details.php';
        exit;
    }

    public function save_flight_details()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->admin->addFlightDetails($_POST);
        }

    }



}


?>