<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="base/all.css" />
    <link rel="stylesheet" href="style/register.css" />

    <link rel="stylesheet" href="base/reset.css" />
</head>

<body>
    <div class="container">

        <div class="left">


        </div>
        <div class="right">
            <form method="POST">
                <h2 style="text-align:center; color:#2d6cdf; margin-bottom: 24px;">Admin Register</h2>
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" name="full_name" id="full_name"
                        value="<?php echo htmlspecialchars($full_name ?? '') ?>">
                    <?php if (isset($errors['full_name'])): ?>
                        <span class="error"><?php echo $errors['full_name']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email ?? '') ?>">
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

                <button type="submit">Register</button>
            </form>

        </div>

</body>

</html>