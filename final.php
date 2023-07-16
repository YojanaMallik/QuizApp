<?php
session_start();
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
unset($_SESSION['score']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url(images/inde.jpg); background-size: cover;">
<header>
    <div class="container">
        <span id="time" style="color: black;"></span>
        <p>Quiz</p>
    </div>
</header>
<main>
    <div class="qa">
        <h2>Your Result</h2>
        <p>Congratulations! You have completed this test successfully.</p>
        <p>Your <strong>Score</strong> is <?php echo $score; ?></p>
        <a href="index.php" class="btnadd">Go to Home</a>
    </div>
</main>
<script>
    let a;
    let date;
    let time;
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    setInterval(() => {
        a = new Date();
        date = a.toLocaleDateString(undefined, options);
        time = a.getHours() + ':' + a.getMinutes() + ':' + a.getSeconds();
        const dayOfWeek = a.toLocaleDateString(undefined, { weekday: 'long' });
        document.getElementById('time').innerHTML = date + " - Time: " + time;
        document.getElementById('item-list').innerHTML = itemHTML;
    }, 1000);
</script>
</body>
</html>
