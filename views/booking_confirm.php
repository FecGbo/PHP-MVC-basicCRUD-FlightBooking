<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            background: #f4f8fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            border-radius: 16px;
            padding: 32px 24px;
        }

        .receipt {
            border: 2px dashed #3498db;
            border-radius: 12px;
            padding: 24px 18px;
            background: #fafdff;
            margin-bottom: 18px;
            word-break: break-word;
        }

        .confirmation-number {
            font-size: 1.3rem;
            color: #217dbb;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 12px 0;
            word-break: break-all;
        }

        .success {
            color: #27ae60;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .note {
            color: #e67e22;
            font-size: 1rem;
            margin-bottom: 18px;
        }

        .back-link {
            display: inline-block;
            margin-top: 12px;
            margin-bottom: 8px;
            padding: 8px 18px;
            background: #3498db;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
            text-align: center;
            min-width: 160px;
        }

        .back-link:hover,
        .back-link:focus {
            background: #217dbb;
            color: #fff;
            outline: none;
        }

        .button-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .button-row .back-link {
            width: auto;
            min-width: 140px;
            margin: 0;
        }

        @media (max-width: 600px) {
            .main-content {
                max-width: 98vw;
                padding: 18px 4vw;
                margin: 16px auto;
            }

            .receipt {
                padding: 14px 4vw;
            }

            .back-link {
                width: 100%;
                min-width: unset;
                font-size: 1rem;
                padding: 10px 0;
                margin-top: 10px;
            }

            .confirmation-number {
                font-size: 1.1rem;
            }

            .button-row {
                flex-direction: column;
                gap: 8px;
                align-items: stretch;
            }

            .button-row .back-link {
                width: 100%;
                min-width: unset;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="main-content">
        <h1 style="text-align:center;">Booking Confirmed!</h1>
        <div class="receipt">
            <div class="success">
                <?php if (!empty($booking)): ?>
                    Your booking was successful.
                <?php else: ?>
                    Booking confirmation not available.
                <?php endif; ?>
            </div>
            <?php if (!empty($booking)): ?>
                <div class="confirmation-number">
                    Confirmation Number: <?= htmlspecialchars($booking['confirmation_number']) ?>
                </div>

                <div class="note">
                    Please keep your confirmation number safe.<br>
                    You will need it to search for your ticket or for any inquiries.
                    <p>Status: <?= htmlspecialchars($booking['status']) ?></p>
                </div>
                <div class="button-row">
                    <a class="back-link"
                        href="index.php?action=download_receipt&confirmation=<?= urlencode($booking['confirmation_number']) ?>"
                        target="_blank">
                        Download Receipt
                    </a>
                    <a class="back-link" href="index.php">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </div>


</body>

</html>