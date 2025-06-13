<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Ticket</title>
    <link rel="stylesheet" href="style/ticket_search.css">
</head>

<body>
    <?php include 'includes/header.php' ?>

    <div class="main-content">
        <h1>Search Tickets</h1>
        <form method="POST" class="search">
            <input type="text" name="confirmation_number" placeholder="Enter confirmation number..." required>
            <button type="submit">Search</button>
        </form>
        <div class="card-container">
            <?php if (isset($searched) && $searched): ?>
                <?php if ($booking): ?>
                    <div class="card">
                        <h3>Booking Details</h3>
                        <div class="card-details-row">
                            <span class="card-details-label">Airline:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['airline']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Departure City:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['departure_city']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Destination City:</span>
                            <span
                                class="card-details-value"><?php echo htmlspecialchars($booking['destination_city']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Departure Time:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['departure_time']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Arrival Time:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['arrival_time']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Days:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['days']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Passenger Name:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['passenger_name']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Booking Date:</span>
                            <span class="card-details-value"><?php echo htmlspecialchars($booking['booking_date']); ?></span>
                        </div>
                        <div class="card-details-row">
                            <span class="card-details-label">Status:</span>
                            <span class="card-details-value">
                                <?php if (strtolower($booking['status']) === 'approved' || strtolower($booking['status']) === 'approve'): ?>
                                    <span style="color:green;">Approved</span>
                                <?php else: ?>
                                    <span style="color:red;"><?php echo htmlspecialchars($booking['status']); ?></span>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <h3>No booking found for this confirmation number.</h3>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer>


        <?php include 'includes/footer.php'; ?>
    </footer>
</body>

</html>