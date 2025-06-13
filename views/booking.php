<?php

session_start();
$traveler_id = $_POST['traveler_id'] ?? '';
$flight_id = $_POST['flight_id'] ?? '';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/booking.css">

</head>

<body>
    <?php include 'includes/header.php' ?>
    <div class="main-content">
        <h1>Booking</h1>

        <div class="container">
            <div class="container-details">
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <form action="index.php?action=booking" method="POST">
                    <input type="hidden" name="traveler_id" value="<?= htmlspecialchars($traveler_id) ?>">
                    <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flight_id) ?>">

                    <p>Traveler Email: <?= htmlspecialchars($traveler_email) ?></p>
                    <?php if (!empty($flight)): ?>
                        <p>Airline: <?= htmlspecialchars($flight['airline'] ?? '') ?></p>
                        <p>Departure City: <?= htmlspecialchars($flight['departure_city'] ?? '') ?></p>
                        <p>Destination City: <?= htmlspecialchars($flight['destination_city'] ?? '') ?></p>
                    <?php endif; ?>

                    <label for="passenger_name">Passenger Name:</label>
                    <input type="text" name="passenger_name" id="passenger_name" required>
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" required>
                    <label for="passport_number">Passport Number:</label>
                    <input type="text" name="passport_number" id="passport_number" required>
                    <button type="submit">Confirm Booking</button>
                    <button type="button" class="back-btn" onclick="window.history.back();">&larr; Back</button>
                </form>
            </div>
        </div>
    </div>







    <?php include 'includes/footer.php'; ?>
</body>

</html>