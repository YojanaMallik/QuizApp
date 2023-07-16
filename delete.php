<?php
include 'db.php';
$qno = $_GET['qno'];

$deletequery1 = "delete from options where question_number= $qno";
$deletequery2 = "delete from questions where question_number= $qno";
$query2 = mysqli_query($connection,$deletequery1);
$query3 = mysqli_query($connection,$deletequery2);
if($query3){
    ?>
    <script>
        alert("Deleted Successfully");
    </script>

    <?php
}else{
    ?>
    <script>
        alert("Not Deleted");
    </script>

    <?php
}

header('location: display.php');




?>