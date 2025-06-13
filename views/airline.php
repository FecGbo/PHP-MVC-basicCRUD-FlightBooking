<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airlines</title>
    <link rel="stylesheet" href="style/airline.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="main-content">
        <h1>Airlines</h1>
        <div class="airlines-grid">
            <?php foreach ($airlines as $airline): ?>
                <div class="airline-card">
                    <img src="<?= htmlspecialchars($airline['logo_url']) ?>"
                        alt="<?= htmlspecialchars($airline['name']) ?> Logo" class="airline-logo"
                        onerror="if(!this._errored){this.src='images/airline-placeholder.png';this._errored=true;}">
                    <div class="airline-name"><?= htmlspecialchars($airline['name']) ?></div>
                    <div class="airline-info"><strong>Code:</strong> <?= htmlspecialchars($airline['code']) ?></div>
                    <div class="airline-info"><strong>Country:</strong> <?= htmlspecialchars($airline['country']) ?></div>
                    <a href="index.php?action=airline_flights&airline=<?= urlencode($airline['name']) ?>"
                        class="view-flights-btn">
                        View Flights
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>

</html>