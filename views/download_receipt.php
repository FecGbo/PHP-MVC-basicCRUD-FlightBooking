<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="booking_receipt_' . htmlspecialchars($booking['confirmation_number']) . '.html"');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f8fb;
        }

        .receipt {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            padding: 32px 24px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
        }

        .receipt-title {
            font-size: 1.5rem;
            color: #217dbb;
            margin-bottom: 18px;
        }

        .receipt-detail {
            margin-bottom: 10px;
        }

        .status {
            font-weight: bold;
            color:
                <?= ($booking['status'] === 'approved') ? '#27ae60' : '#e67e22' ?>
            ;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="receipt-title">Booking Receipt</div>
        <div class="receipt-detail"><strong>Confirmation Number:</strong>
            <?= htmlspecialchars($booking['confirmation_number'] ?? $booking['confirmation_number']) ?></div>
        <div class="receipt-detail"><strong>Passenger Name:</strong>
            <?= htmlspecialchars($booking['passenger_name'] ?? '') ?></div>
        <div class="receipt-detail"><strong>Flight:</strong> <?= htmlspecialchars($booking['airline'] ?? '') ?></div>
        <div class="receipt-detail"><strong>From:</strong> <?= htmlspecialchars($booking['departure_city'] ?? '') ?>
            <strong>To:</strong> <?= htmlspecialchars($booking['destination_city'] ?? '') ?>
        </div>
        <div class="receipt-detail"><strong>Departure:</strong>
            <?= htmlspecialchars($booking['departure_time'] ?? '') ?></div>
        <div class="receipt-detail"><strong>Arrival:</strong> <?= htmlspecialchars($booking['arrival_time'] ?? '') ?>
        </div>
        <div class="receipt-detail"><strong>Status:</strong> <span
                class="status"><?= htmlspecialchars($booking['status'] ?? '') ?></span></div>
        <div class="receipt-detail"><strong>Booking Date:</strong>
            <?= htmlspecialchars($booking['booking_date'] ?? '') ?></div>

    </div>
</body>

</html>