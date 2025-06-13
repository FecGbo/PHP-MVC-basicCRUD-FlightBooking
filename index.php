<?php
require_once 'config/database.php';
require_once 'controllers/traveller_controller.php';
require_once 'controllers/admin_controller.php';
require_once 'models/admin_abstract.php';


$db = (new Database())->connect();
$travellerController = new traveller_controller($db);

$adminModel = new admin_abstract($db);
$adminController = new admin_controller($adminModel);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
switch ($action) {
    case 'traveller_reg':
        $travellerController->register($_POST);
        break;
    case 'traveller_login':
        $travellerController->login();
        break;
    case 'traveller_logOut':
        $travellerController->traveller_logOut();
        break;
    case 'flight':
        $travellerController->flight_details();
        break;
    case 'rent_car':
        $travellerController->rent_car();
        break;

    case 'search':
        $travellerController->search();
        break;
    case 'booking':
        $travellerController->book();
        break;
    // case 'booking_confirm':
    //     $travellerController->confirm_booking();
    //     break;
    case 'admin_pending_bookings':
        $adminController->showPendingBookings();
        break;
    case 'admin_approve_booking':
        $adminController->approveBooking();
        break;
    case 'login_select':
        include 'views/login_select.php';
        break;
    case 'admin_login':
        $adminController->login();
        break;
    case 'admin_reg':
        $adminController->register();
        break;
    case 'process_payment':
        $travellerController->process_payment();
        break;

    case 'admin_add_flight':
        $adminController->add_flight($_POST);
        break;
    case 'search_ticket':
        $travellerController->search_ticket_status();
        break;
    case 'admin_edit_flight':
        $adminController->get_flight();
        break;
    case 'airline':
        $travellerController->airlines();
        break;
    case 'download_receipt':
        $travellerController->download_receipt();
    case 'admin_add_flight_details':
        $adminController->admin_add_flight_details();
    case 'save_flight_details':
        $adminController->save_flight_details();
    default:
        $travellerController->index();
        break;
}
?>