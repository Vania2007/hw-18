<?php
if (isset($_POST['hidden-number'])) {
    $n = $_POST['hidden-number'];
} else {
    $n = rand(1, 100);
}

$count = 0;
$text = ""; 
$nameErr = ""; 

if (isset($_POST['Submit'])) { 
    $count = $_POST['hidden-count'];
    $count++; 

    if (empty($_POST["my_number"])) { 
        $nameErr = "Число обов'язкове для введення!";
    } else {
        $my_number = trim($_POST["my_number"]); 
        if (!preg_match("/^(100|[1-9][0-9]?)$/", $my_number)) {
            $nameErr = "Дозволяється лише число від 1 до 100!";
        }
    }

    if ($nameErr === "") { 
        if ($my_number > $n) {
            $text = "Занадто багато! Кількість спроб: " . str_repeat("|", $count);
        } elseif ($my_number < $n) {
            $text = "Замало! Кількість спроб: " . str_repeat("|", $count);
        } else {
            $text = "Точно! Вгадано з $count спроби!";
            $n = rand(1, 100);
            $count = 0;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гра: Вгадай число</title>
</head>

<body>
    <p>Вгадай число от 1 до 100:</p>
    <form action="<?=$_SERVER['PHP_SELF']?>" name="myform" method="POST">
        <input type="text" name="my_number" size="5"><?=$text?><?=$nameErr?><br />
        <input type="hidden" name="hidden-count" size="50" value="<?=$count?>">
        <input type="hidden" name="hidden-number" size="50" value="<?=$n?>">
        <input name="Submit" type="submit" value="Відправити"><br />
    </form>
</body>
</html>