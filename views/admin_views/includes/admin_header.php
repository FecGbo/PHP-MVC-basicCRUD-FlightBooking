<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
$admin_id = $_SESSION['admin_id'] ?? null;
?>
<!-- <link rel="stylesheet" href="base/all.css"> -->
<!-- <link rel="stylesheet" href="base/reset.css"> -->
<link rel="stylesheet" href="style/index.css">



<div class="header-container">
    <div class="header-logo">Heaven</div>

    <button class="hamburger" id="hamburger-btn" aria-label="Open navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="nav-left" id="nav-menu">
        <a href="index.php?action=admin_pending_bookings">Home</a>
        <a href="index.php?action=admin_add_flight">Add Flights</a>
        <a href="index.php?action=admin_edit_flight">Edit Flights</a>


    </div>
    <div class="nav-right">
        <?php if (isset($admin_id) && !empty($admin_id)): ?>
            <!-- <span><?php // echo htmlspecialchars($traveler_name ?? $traveler_email ?? ''); ?></span> -->
            <a href="index.php?action=traveller_logOut">Log Out</a>
        <?php else: ?>
            <a href="index.php?action=login_select">Log In</a>
        <?php endif; ?>
    </div>

</div>
<?php if (isset($_SESSION['admin_email'])): ?>
    <div style="color: green; margin: 10px 20px;">
        Welcome, <?php echo htmlspecialchars($_SESSION['admin_email']); ?>!
    </div>
<?php endif; ?>
<script>
    document.getElementById('hamburger-btn').onclick = function () {
        document.getElementById('nav-menu').classList.toggle('open');
    };
</script>