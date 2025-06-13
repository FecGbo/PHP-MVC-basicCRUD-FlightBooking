<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style/payment.css" />

</head>

<body>
    <?php include 'includes/header.php' ?>

    <div class="main-content">
        <h1>Payment</h1>
        <div class="container">
            <div class="container-details">
                <form method="post" action="index.php?action=process_payment">
                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_id) ?>">
                    <input type="hidden" name="amount" value="<?= htmlspecialchars($amount) ?>">
                    <p><strong>Amount to Pay:</strong> $<?= htmlspecialchars($amount) ?></p>
                    <label>Payment Method:</label>
                    <select name="payment_method" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Other">Other</option>
                    </select><br>
                    <label>Card Number:</label>
                    <input type="text" name="card_number" maxlength="16" required><br>
                    <label>Expiry Date:</label>
                    <input type="text" name="expiry_date" placeholder="MM/YY" required><br>
                    <label>CVV:</label>
                    <input type="text" name="cvv" maxlength="4" required><br>
                    <button type="submit" name="pay" value="pay">Pay Now</button>
                    <button type="submit" name="cancel" value="cancel"
                        style="background:#e74c3c;color:#fff;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>