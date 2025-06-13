<?php
//session_start();
?>


<?php include 'includes/admin_header.php'; ?>
<link rel="stylesheet" href="style/addflight.css">

<div class="main-content">

    <form method="post" enctype="multipart/form-data">
        <label for="">Airline:</label>
        <input type="text" name="airline" id="airline" required autocomplete="off"> <br><br>

        <div id="airline-extra-fields" style="display:none;">
            <label for="">Airline Code:</label>
            <input type="text" name="airline_code" id="airline_code"><br><br>

            <label for="">Airline Country:</label>
            <input type="text" name="airline_country" id="airline_country"><br><br>


            <label for="airline_logo">Airline Logo:</label>
            <input type="file" name="airline_logo" id="airline_logo" accept="image/*"><br><br>
        </div>

        <label for="">Departure City:</label>
        <input type="text" name="departure_city" required><br><br>

        <label for="">Destination City:</label>
        <input type="text" name="destination_city" required><br><br>

        <label for="">Departure Time:</label>
        <input type="datetime-local" name="departure_time" required><br><br>

        <label for="">Arrival Time:</label>
        <input type="datetime-local" name="arrival_time" required><br><br>

        <label for="">Day:</label>
        <input type="text" name="day"><br><br>

        <label for="">Price:</label>
        <input type="number" name="price"><br><br>

        <label for="">Seats</label>
        <input type="number" name="seat">



        <button type="submit">Add Flight</button>
    </form>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-info" style="margin:10px 20px;">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
</div>

<?php
$existingAirlines = [];
if (isset($allAirlines)) {
    foreach ($allAirlines as $a) {
        $existingAirlines[] = strtolower($a['name']);
    }
}
?>
<script>
    const existingAirlines = <?= json_encode($existingAirlines) ?>;

    document.getElementById('airline').addEventListener('input', function () {
        const val = this.value.trim().toLowerCase();
        const extraFields = document.getElementById('airline-extra-fields');
        if (val && !existingAirlines.includes(val)) {
            extraFields.style.display = 'block';
        } else {
            extraFields.style.display = 'none';
            document.getElementById('airline_code').value = '';
            document.getElementById('airline_country').value = '';
        }
    });
    console.log(existingAirlines);
</script>