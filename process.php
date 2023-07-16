<?php
    include 'db.php';
    session_start();

    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    if ($_POST) {
        $number = $_POST['number'];
        $selected_choice = $_POST['choice'];

        $query = "SELECT * FROM questions";
        $total_questions = mysqli_num_rows(mysqli_query($connection, $query));

        $query = "SELECT * FROM options WHERE question_number = $number AND is_correct = 1";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $correct_choice = $row['id'];

        if ($selected_choice == $correct_choice) {
            $_SESSION['score']++;
        }

        $next = $number + 1;

        if ($number == $total_questions) {
            header("LOCATION: final.php");
        } else {
            header("LOCATION: question.php?n=" . $next);
        }
    }
?>
