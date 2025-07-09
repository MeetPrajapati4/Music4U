<?php
session_start();

if (!isset($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        $_SESSION['click_count'] = 0;
    } else {
        $_SESSION['click_count']++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Counter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .count {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Click the Button to Increase the Count!</h1>

    <div class="count">
        Current Click Count: <?php echo $_SESSION['click_count']; ?>
        <?php
        if ($_SESSION['click_count'] >= 10) {
            echo "<br><br>";
            echo "<h2>10 clicks reached!</h2>";
        }
        ?>
    </div>

    <form method="POST">
        <button class="button" type="submit" name="submit">Click Me!</button>
        <button class="button" type="submit" name="reset">Reset</button>
    </form>

</body>

</html>

