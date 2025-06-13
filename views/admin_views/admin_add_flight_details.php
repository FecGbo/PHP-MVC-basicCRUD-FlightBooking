<?php include 'includes/admin_header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/addDetails.css">


<!-- <style>
    .details-form-container {
        max-width: 500px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
        padding: 32px 24px;
    }

    .details-form-container h2 {
        text-align: center;
        color: #217dbb;
        margin-bottom: 24px;
        font-size: 1.5rem;
    }

    .details-form .form-row {
        display: flex;
        gap: 18px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .details-form label {
        flex: 1 1 180px;
        display: flex;
        flex-direction: column;
        font-weight: 500;
        color: #333;
        font-size: 1rem;
    }

    .details-form input[type="text"],
    .details-form textarea {
        margin-top: 6px;
        padding: 8px 10px;
        border: 1px solid #b5c9d6;
        border-radius: 5px;
        font-size: 1rem;
        background: #fafdff;
        transition: border 0.2s;
    }

    .details-form input[type="text"]:focus,
    .details-form textarea:focus {
        border: 1.5px solid #3498db;
        outline: none;
    }

    .details-form textarea {
        resize: vertical;
        min-height: 40px;
    }

    .submit-btn {
        display: block;
        width: 100%;
        background: #27ae60;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: bold;
        margin-top: 18px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .submit-btn:hover,
    .submit-btn:focus {
        background: #219150;
    }

    .alert.alert-info {
        background: #eaf6ff;
        color: #217dbb;
        border: 1px solid #b5c9d6;
        border-radius: 6px;
        padding: 10px 16px;
        margin-top: 18px;
        text-align: center;
        font-size: 1rem;
    }

    @media (max-width: 600px) {
        .details-form-container {
            padding: 18px 4vw;
            margin: 18px 0;
        }

        .details-form .form-row {
            flex-direction: column;
            gap: 8px;
        }

        .details-form label {
            font-size: 0.98rem;
        }
    }
</style> -->

<?php
$flight_id = $_GET['flight_id'] ?? '';
?>
<div class="details-form-container">
    <h2>Add Flight Details</h2>
    <form method="post" action="index.php?action=save_flight_details" class="details-form">
        <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flight_id) ?>">
        <div class="form-row">
            <label>Aircraft Type
                <input type="text" name="aircraft_type" required>
            </label>
            <label>Gate Number
                <input type="text" name="gate_number" required>
            </label>
        </div>
        <div class="form-row">
            <label>Duration
                <input type="text" name="duration" required>
            </label>
            <label>Meal
                <input type="text" name="meal">
            </label>
        </div>
        <div class="form-row">
            <label>In-Flight Entertainment
                <input type="text" name="in_flight_entertainment">
            </label>
            <label>WiFi Available
                <input type="text" name="wifi_available">
            </label>
        </div>
        <div class="form-row">
            <label>Notes
                <textarea name="notes" rows="2"></textarea>
            </label>
        </div>
        <div class="form-row">
            <label>Image URL
                <input type="text" name="image_url">
            </label>
        </div>
        <button type="submit" class="submit-btn">Save Details</button>

        <button type="button" class="submit-btn" style="background:#888;" onclick="window.history.back();">Back</button>
    </form>
</div>

<?php
if (isset($_SESSION['flash_message'])):
    ?>
    <div class="alert alert-info" style="margin:10px 20px;">
        <?= htmlspecialchars($_SESSION['flash_message']) ?>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>