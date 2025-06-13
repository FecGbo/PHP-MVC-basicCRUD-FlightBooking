<?php
session_start();


?>


<?php include 'includes/admin_header.php'; ?>

<link rel="stylesheet" href="style/search.css">

<div class="main-content">
    <?php if (!empty($pending)): ?>
        <table>


            <tr>
                <th>Booking ID</th>
                <th>Traveller ID</th>
                <th>Flight ID</th>
                <th>Passenger Name</th>
                <th>DOB</th>
                <th>Passport</th>
                <th>Booking Date</th>
                <th>Confirmation Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php foreach ($pending as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                    <td><?= htmlspecialchars($booking['traveler_id']) ?></td>
                    <td><?= htmlspecialchars($booking['flight_id']) ?></td>
                    <td><?= htmlspecialchars($booking['passenger_name']) ?></td>
                    <td><?= htmlspecialchars($booking['date_of_birth']) ?></td>
                    <td><?= htmlspecialchars($booking['passport_number']) ?></td>
                    <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                    <td><?= htmlspecialchars($booking['confirmation_number']) ?></td>
                    <td><?= htmlspecialchars($booking['status']) ?></td>
                    <td id="approve-btn">
                        <?php if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])): ?>
                            <form method="POST" action="index.php?action=admin_approve_booking" style="display:inline;"
                                id="approve-btn">
                                <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                <button type="submit" class="search-btn">Approve</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>