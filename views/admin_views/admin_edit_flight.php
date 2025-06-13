<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <link rel="stylesheet" href="style/admin_edit_flight.css">
</head>

<body>
    <?php include 'includes/admin_header.php'; ?>

    <div class="main-content">
        <div class="table-responsive">
            <table>
                <thead>

                    <!-- flight_id
airline
departure_city
destination_city
departure_time
arrival_time
Days
price
available_seats -->
                    <tr>
                        <td></td>
                        <td>Airline</td>
                        <td>Departure City</td>
                        <td>Destination City</td>
                        <td>Departure Time</td>
                        <td>Arrival Time</td>
                        <td>Days</td>
                        <td>Price</td>
                        <td>Available Seats</td>
                        <td>Action</td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($flights as $flight): ?>
                        <tr data-id="<?php echo $flight['flight_id']; ?>">

                            <td>
                                <a href="index.php?action=admin_add_flight_details&flight_id=<?= urlencode($flight['flight_id']) ?>"
                                    class="">
                                    Add Details
                                </a>
                            </td>

                            <td contenteditable=" false" data-label="Airline">
                                <?php echo htmlspecialchars($flight['airline']); ?>
                            </td>
                            <td contenteditable="false" data-label="Departure City">
                                <?php echo htmlspecialchars($flight['departure_city']); ?>
                            </td>
                            <td contenteditable="false" data-label="Destination City">
                                <?php echo htmlspecialchars($flight['destination_city']); ?>
                            </td>
                            <td contenteditable="false" data-label="Departure Time">
                                <?php echo htmlspecialchars($flight['departure_time']); ?>
                            </td>
                            <td contenteditable="false" data-label="Arrival Time">
                                <?php echo htmlspecialchars($flight['arrival_time']); ?>
                            </td>
                            <td contenteditable="false" data-label="Days"><?php echo htmlspecialchars($flight['Days']); ?>
                            </td>
                            <td contenteditable="false" data-label="Price"><?php echo htmlspecialchars($flight['price']); ?>
                            </td>
                            <td contenteditable="false" data-label="Available Seats">
                                <?php echo htmlspecialchars($flight['available_seats']); ?>
                            </td>
                            <td data-label="Action">
                                <button class="edit-btn">Edit</button>
                                <button class="save-btn" style="display:none;">Save</button>
                                <button class="cancel-btn" style="display:none;">Cancel</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var row = btn.closest('tr');
                row.querySelectorAll('td[contenteditable]').forEach(td => td.contentEditable = true);
                btn.style.display = 'none';
                row.querySelector('.save-btn').style.display = '';
                row.querySelector('.cancel-btn').style.display = '';
            });
        });
        document.querySelectorAll('.cancel-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                location.reload(); // Simple way to reset changes
            });
        });
        document.querySelectorAll('.save-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var row = btn.closest('tr');
                var data = {
                    id: row.getAttribute('data-id'),
                    airline: row.children[0].innerText,
                    departure_city: row.children[1].innerText,
                    destination_city: row.children[2].innerText,
                    departure_time: row.children[3].innerText,
                    arrival_time: row.children[4].innerText,
                    Days: row.children[5].innerText,
                    price: row.children[6].innerText,
                    available_seats: row.children[7].innerText
                };
                // Send data to PHP via AJAX (example using fetch)
                fetch('views/admin_views/update_flight.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                }).then(res => res.json()).then(response => {
                    if (response.success) {
                        row.querySelectorAll('td[contenteditable]').forEach(td => td.contentEditable = false);
                        btn.style.display = 'none';
                        row.querySelector('.cancel-btn').style.display = 'none';
                        row.querySelector('.edit-btn').style.display = '';
                    } else {
                        alert('Update failed');
                    }
                });
            });
        });
    </script>
</body>

</html>