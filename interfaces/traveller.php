<?php
interface traveller
{
    /**
     * Register a new traveller.
     *
     * @param array $data The traveller data.
     * @return bool True on success, false on failure.
     */

    public function register($data): array;
    public function login($data);
    public function search($data);
    public function booking($data);
    public function getTravellerEmail($id);
    public function getBookingByConfirmation($data);
    public function savePayment($data);
    public function getFlightById($id);
    public function getBookingById($id);
    public function deletePyamentsByBookingId($id);

    public function deleteBooking($id);

    public function getNotification($traveller_id);


    public function clearNotification($traveller_id);
    public function searchByConfirmationNumber($confirmationNumber);


    public function getFiightDetails($flight_id);

    public function getAllAirline();

}


?>