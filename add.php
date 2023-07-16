
<?php include 'db.php';
if (isset($_POST['submit']))
{
    $question_number=$_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
    //Choice Array
    $choice = array();
    $choice[1]= $_POST['choice1'];
    $choice[2]= $_POST['choice2'];
    $choice[3]= $_POST['choice3'];
    $choice[4]= $_POST['choice4'];
    $choice[5]= $_POST['choice5'];

    //First Query for Question Table

    $query = "INSERT INTO questions (question_number,question_text) values ('{$question_number}','{$question_text}')";

    $result = mysqli_query($connection,$query);

    //Validate First Query
    if($result)
    {
        foreach ($choice as $option => $value)
        {
            if($value != "")
            {
                if($correct_choice == $option)
                {
                    $is_correct = 1;
                }
                else{
                    $is_correct = 0;
                }


                //Second Query for options Table
                $query = "INSERT INTO options (question_number,is_correct,coption) values ('{$question_number}','{$is_correct}','{$value}')"; 
                $insert_row = mysqli_query($connection,$query);
                //Validate insertion of Choices

                if($insert_row){
                     continue;
                }
                else{
                     die("2nd Query for Choices could not be executed");
                }
            }
        }
        $message = "Question has been added successfully";
    }
}

    $query = "SELECT * FROM questions";
    $questions = mysqli_query($connection,$query);
    $total = mysqli_num_rows($questions);
    $next = $total +1;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body style="background-image: url(images/inde.jpg); background-size: cover;">
<header>
        <div class="container">
        <span id="time" style="color: black;"></span>
                
        </div>
    </header>
    <style>
        @media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
    </style>
    <main>
        <div class="maindivs">
        <div class="add">
            
            <h2>Add a question</h2>
            <div style="align-items: center;">
            <?php
            if(isset($message)){
                echo "<h4>" . $message . "</h4>";
            }
            ?></div>
            <div class="formq">
                <form method="POST" action="add.php">
                    <p>
                    <label>Question Number:</label>
                    <input type="number" name="question_number" value="<?php echo $next;  ?>" >
                    </p>
                    <p>
                    <label>Question Text:</label>
                    <input type="text" name="question_text" >
                    </p>
                    <p>
                    <label>Option 1:</label>
                    <input type="text" name="choice1">
                    </p>
                    <p>
                    <label>Option 2:</label>
                    <input type="text" name="choice2">
                    </p>
                    <p>
                    <label>Option 3:</label>
                    <input type="text" name="choice3">
                    </p>
                    <p>
                    <label>Option 4:</label>
                    <input type="text" name="choice4">
                    </p>
                    <p>
                    <label>Option 5:</label>
                    <input type="text" name="choice5">
                    </p>
                    <p>
                    <label>Correct Option Number: </label>
                    <input type="number" name="correct_choice">
                    </p>
                

                    <input type="submit" name="submit" value="Next" class="btnadd" >
                </form>
            </div>
        
            
        </div>
        <div class="delhome">
                <a href="display.php" class="btnadd">Delete</a>
                <a href="index.php" class="btnadd">Home</a>
        </div>
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