<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveller Log</title>

    <link rel="stylesheet" href="style/login.css">

</head>

<form method="POST">

    <h2 style="text-align:center; color:#2d6cdf; margin-bottom: 24px;">Login</h2>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"
            value="<?php echo htmlspecialchars($email ?? $_COOKIE['remember_email'] ?? ''); ?>">
        <?php if (isset($errors['email'])): ?>
            <span class="error"><?php echo $errors['email']; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <?php if (isset($errors['password'])): ?>
            <span class="error"><?php echo $errors['password']; ?></span>
        <?php endif; ?>
    </div>

    <!-- <div class="form-group">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember" <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
            Remember Me
        </label>
    </div> -->

    <button type="submit">Log In</button>

    <div class="register">
        <a href="index.php?action=traveller_reg">Register Account</a>
    </div>
    <button type="button" class="back-btn" onclick="window.history.back();">&larr; Back</button>
</form>
</body>

</html>