<?php
//session_start();

require_once 'models/traveller_abstract.php';
$traveler_id = $_SESSION['traveler_id'] ?? null;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/search.css">

</head>

<body>

    <?php include 'includes/header.php'; ?>


    <div class="main-content">

        <div class="container">
            <div class="container-details">
                <h1>Your Ticket To</h1>
                <h1>Explore The World</h1>

            </div>
            <div class="container-search">
                <form action="index.php" method="GET">
                    <input type="text" name="airline" placeholder="Airline">
                    <input type="text" name="from_city" placeholder="From City">
                    <input type="text" name="to_city" placeholder="To City">
                    <input type="text" name="departure_time" placeholder="Departure Date">
                    <input type="text" name="days" placeholder="Days">
                    <button type="submit">Search</button>
                </form>






            </div>

            <?php if (!empty($results)): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Airline</th>
                                <th>Departure City</th>
                                <th>Destination City</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Days</th>
                                <th>Price</th>
                                <th>Available Seats</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td data-label="Airline"><?= htmlspecialchars($row['airline']) ?></td>
                                    <td data-label="Departure City"><?= htmlspecialchars($row['departure_city']) ?></td>
                                    <td data-label="Destination City"><?= htmlspecialchars($row['destination_city']) ?></td>
                                    <td data-label="Departure Time"><?= htmlspecialchars($row['departure_time']) ?></td>
                                    <td data-label="Arrival Time"><?= htmlspecialchars($row['arrival_time']) ?></td>
                                    <td data-label="Days"><?= htmlspecialchars($row['Days']) ?></td>
                                    <td data-label="Price"><?= htmlspecialchars($row['price']) ?></td>
                                    <td data-label="Available Seats"><?= htmlspecialchars($row['available_seats']) ?></td>
                                    <td data-label="Action" class="action">
                                        <?php if (isset($traveler_id) && !empty($traveler_id)): ?>
                                            <form action="index.php?action=booking" method="POST" style="display:inline;">
                                                <input type="hidden" name="flight_id"
                                                    value="<?= htmlspecialchars($row['flight_id']) ?>">
                                                <input type="hidden" name="traveler_id"
                                                    value="<?= htmlspecialchars($traveler_id) ?>">
                                                <button class="search-btn" type="submit">BOOK NOW</button>
                                            </form>
                                        <?php endif; ?>
                                        <a class="details-btn"
                                            href="index.php?action=flight&flight_id=<?= htmlspecialchars($row['flight_id']) ?>">
                                            More Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>

        </div>
    </div>





    <?php include 'views/includes/footer.php'; ?>


</body>

</html>