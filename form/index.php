<?php
include 'db.php';

$error = "";

if (isset($_POST['submitB'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));

    if (empty($login) || empty($pass)) {
    } else {
        $userFound = false;
        foreach ($accounts as $account) {
            if ($account['login'] === $login && $account['pass'] === $pass) {
                $userFound = true;
                if ($account['role'] === 'admin') {
                    header("Location: admin.php?login=" . urlencode($login));
                } else {
                    header("Location: user.php?login=" . urlencode($login));
                }
                exit;
            }
        }
        if (!$userFound) {
            $error = "Такого акаунту не знайдено!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<h2>Login</h2>
<?php if ($error){ ?>
    <strong><div style="color: red;"><?php echo $error; ?></div></strong>
<?php }?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Введіть ім'я: <input type="text" name="login"/><br/>
  Введіть пароль (не менш ніж 4 символи): <input type="password" name="pass"/><br/>
  <input type="submit" name="submitB" value="Підтвердити"/>
</form>
</body>
</html>