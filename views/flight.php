<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Details</title>
    <link rel="stylesheet" href="style/flight_detail.css">
</head>

<body>
    <?php include 'includes/header.php' ?>

    <main class="main-content">
        <section class="container">
            <article class="container-details">
                <?php if ($flights && !empty($flights['image_url'])): ?>
                    <img src="<?= htmlspecialchars($flights['image_url']) ?>" alt="Flight Image" class="flight-image-full">
                <?php endif; ?>
                <h1 class="details-title">Flight Details</h1>
                <?php if ($flights): ?>
                    <ul class="details-list">
                        <li><strong>Aircraft Type:</strong> <?= htmlspecialchars($flights['aircraft_type']) ?></li>
                        <li><strong>Gate Number:</strong> <?= htmlspecialchars($flights['gate_number']) ?></li>
                        <li><strong>Duration:</strong> <?= htmlspecialchars($flights['duration']) ?></li>
                        <li><strong>Meal:</strong> <?= htmlspecialchars($flights['meal']) ?></li>
                        <li><strong>In-Flight Entertainment:</strong>
                            <?= htmlspecialchars($flights['in_flight_entertainment']) ?></li>
                        <li><strong>WiFi Available:</strong> <?= htmlspecialchars($flights['wifi_available']) ?></li>
                        <li><strong>Notes:</strong> <?= htmlspecialchars($flights['notes']) ?></li>
                        <li><strong>Airline:</strong> <?= htmlspecialchars($flights['airline']) ?></li>
                        <li><strong>Departure City:</strong> <?= htmlspecialchars($flights['departure_city']) ?></li>
                        <li><strong>Destination City:</strong> <?= htmlspecialchars($flights['destination_city']) ?></li>
                        <li><strong>Departure Time:</strong> <?= htmlspecialchars($flights['departure_time']) ?></li>
                        <li><strong>Arrival Time:</strong> <?= htmlspecialchars($flights['arrival_time']) ?></li>
                        <li><strong>Days:</strong> <?= htmlspecialchars($flights['Days']) ?></li>
                        <li><strong>Price:</strong> $<?= htmlspecialchars($flights['price']) ?></li>
                    </ul>
                <?php else: ?>
                    <p class="no-details">No details found for this flight.</p>
                <?php endif; ?>
                <?php if (isset($_SESSION['traveler_id']) && !empty($_SESSION['traveler_id'])): ?>
                    <form action="index.php?action=booking" method="POST" style="margin-top:18px;">
                        <input type="hidden" name="traveler_id" value="<?= htmlspecialchars($_SESSION['traveler_id']) ?>">
                        <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flights['flight_id']) ?>">
                        <button type="submit" class="book-btn">Book Now</button>
                    </form>
                <?php endif; ?>

                <button type="button" class="back-btn" onclick="window.history.back();">&larr; Back</button>
            </article>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>