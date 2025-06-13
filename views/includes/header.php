<?php

$traveler_id = $_SESSION['traveler_id'] ?? null;
$traveler_name = $_SESSION['traveler_name'] ?? null;
$traveler_email = $_SESSION['traveler_email'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;
$notification = $notification ?? null;


?>


<link rel="stylesheet" href="style/index.css">

<div class="header-container">
    <div class="header-logo">Traveller Go</div>
    <button class="hamburger" id="hamburger-btn" aria-label="Open navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="nav-left" id="nav-menu">
        <a href="index.php?action=index">Home</a>
        <a href="index.php?action=airline">Airlines</a>
        <a href="index.php?action=search_ticket">Search Tickets</a>

    </div>
    <div class="nav-right">

        <?php if (isset($traveler_id) && !empty($traveler_id)): ?>
            <div style="display:inline-block; position:relative;">
                <button id="noti-btn" style="background:none; border:none; cursor:pointer; position:relative;">
                    <span style="font-size:1.5em;">&#128276;</span>
                    <?php if (isset($_SESSION['flash_notification'])): ?>
                        <span
                            style="position:absolute;top:0;right:0;width:10px;height:10px;background:#e74c3c;border-radius:50%;"></span>
                    <?php endif; ?>
                </button>
                <div id="noti-dropdown"
                    style="display:none;position:absolute;right:0;top:30px;background:#fff;border:1px solid #ccc;border-radius:6px;min-width:220px;z-index:1000;box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                    <?php if (isset($_SESSION['flash_notification'])): ?>
                        <div style="padding:12px 16px;color:#27ae60;">
                            <?= htmlspecialchars($_SESSION['flash_notification']) ?>
                        </div>
                        <?php unset($_SESSION['flash_notification']); ?>
                    <?php else: ?>
                        <div style="padding:12px 16px;color:#888;">No new notifications</div>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['last_confirmation_number'])): ?>
                        <a class="back-link" style="margin:10px 16px 10px 16px;display:inline-block;"
                            href="index.php?action=download_receipt&confirmation=<?= urlencode($_SESSION['last_confirmation_number']) ?>"
                            target="_blank">
                            Download Approved Receipt
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($traveler_id) && !empty($traveler_id)): ?>
            <a href="index.php?action=traveller_logOut">Log Out</a>
        <?php else: ?>
            <a href="index.php?action=login_select">Log In</a>
        <?php endif; ?>
    </div>
</div>
<?php if (isset($_SESSION['traveler_email'])): ?>
    <div style="color: green; margin: 10px 20px;">
        Welcome, <?php echo htmlspecialchars($_SESSION['traveler_email']); ?>!



    </div>
<?php endif; ?>
<?php if (isset($_SESSION['traveler_name'])): ?>
    <div style="color: green; margin: 10px 20px;">
        Welcome, <?php echo htmlspecialchars($_SESSION['traveler_name']); ?>!



    </div>
<?php endif; ?>






<script>
    document.getElementById('hamburger-btn').onclick = function () {
        document.getElementById('nav-menu').classList.toggle('open');
    };
    document.getElementById('noti-btn').onclick = function (e) {
        e.stopPropagation();
        var dropdown = document.getElementById('noti-dropdown');
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    };
    document.body.onclick = function () {
        var dropdown = document.getElementById('noti-dropdown');
        if (dropdown) dropdown.style.display = 'none';
    };
</script>