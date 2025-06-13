<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveller Log</title>

    <link rel="stylesheet" href="style/login.css">

</head>

<body>
    <form action="" method="POST">
        <h2 style="text-align:center; color:#2d6cdf; margin-bottom: 24px;">Login</h2>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required
                value="<?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : ''; ?>">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>


        <button type="submit">Log In</button>



        <div class="register">
            <a href="index.php?action=admin_reg">Register Account</a>
        </div>
        <button type="button" class="back-btn" onclick="window.history.back();">&larr; Back</button>

        <?php if (!empty($err)): ?>
            <div style="color: red;">
                <?php echo htmlspecialchars($err); ?>
            </div>
        <?php endif; ?>
    </form>
</body>

</html>