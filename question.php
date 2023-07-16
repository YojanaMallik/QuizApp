<?php
    include 'db.php';
    session_start();
    // Set Question Number
    $number = $_GET['n'];

    // Query for the Question
    $query = "SELECT * FROM questions where question_number = $number";
    $result = mysqli_query($connection, $query);
    $question = mysqli_fetch_assoc($result);

    // Get Choices
    $query = "SELECT * FROM options WHERE question_number = $number";
    $choices = mysqli_query($connection, $query);

    // Get Total questions
    $query = "SELECT * FROM questions";
    $total_questions = mysqli_num_rows(mysqli_query($connection, $query));

    $selected_choice = null;
    if (isset($_POST['choice'])) {
        $selected_choice = $_POST['choice'];
    }
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
            <div class="current">Question <?php echo $number; ?> of <?php echo $total_questions; ?></div>
            <p class="question"><?php echo $question['question_text']; ?></p>
        </div>

        <div class="ans">
            <form method="POST" action="process.php">
                <ul class="choices">
                    <?php while ($row = mysqli_fetch_assoc($choices)) { ?>
                        <li>
                            <label class="button" onclick="checkOption(this, <?php echo $row['is_correct']; ?>)">
                                <input type="radio" name="choice" value="<?php echo $row['id']; ?>">
                                <?php echo $row['coption']; ?>
                            </label>
                        </li>
                    <?php } ?>
                </ul>

                <input type="hidden" name="number" value="<?php echo $number; ?>">
                <input type="submit" name="submit" value="Next" class="btnadd" id="qsub">
            </form>
        </div>
    </main>
    <script>
        function checkOption(button, isCorrect) {
  var selectedChoice = button.querySelector('input[name="choice"]').value;
  var result = isCorrect ? 'correct' : 'incorrect';
  console.log('Selected option is ' + result);
  
  // Remove previous result classes from all buttons
  var buttons = document.querySelectorAll('.choices li label.button');
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('correct');
    buttons[i].classList.remove('incorrect');
  }

  // Add the result class to the clicked button
  button.classList.add(result);
}

    </script>
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
