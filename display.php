
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-image: url(images/inde.jpg); background-size: cover;">
    <header>
        <div class="container">
        <span id="time" style="color: black;"></span>
                <p>Quiz</p>
                
        </div>
    </header>
    <main>
        <div class="main-div">
            <h1>Update Questions</h1>
            <div style="margin-top: 30px;"><a href="index.php" class="btnadd">Home</a> <a href="add.php" class="btnadd">Add</a></div>
            <div class="center-div">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Question Number</th>
                                <th>Question Text</th>
                                <th>Correct(1)</th>
                                <th>Options</th>
                                <th colspan="2">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            include 'db.php';

                            $selectquery = " select question_number,question_text,is_correct,coption from questions natural join options";
                            $query1 = mysqli_query($connection,$selectquery);

                            while($res= mysqli_fetch_array($query1)){
                                ?>
                            <tr>
                                <td><?php echo $res['question_number'];?></td>
                                <td><?php echo $res['question_text'];?></td>
                                <td><?php echo $res['is_correct'];?></td>
                                <td><?php echo $res['coption'];?></td>
                                <td><a href="delete.php?qno=<?php echo $res['question_number']; ?>" data-toggle="tooltip" data-placement="bottom" title="DELETE"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                            }
                        ?>
                            
                        </tbody>
                    </table>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>