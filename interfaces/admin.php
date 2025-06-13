<?php

interface Admin
{
    // public function getAll();
    public function getPendingBookings();
    public function approveBooking($id);
    public function register($data): array;
    public function login($data);
    public function getBookingById($id);

    public function decrementAvailableSeats($flightId);


    public function setBookingNotification($bookingId, $message);

    public function addFlight($data);
    public function getFlight();
    public function getAirline();
    public function addFlightDetails($data);



}



?>