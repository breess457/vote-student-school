<?php

$conn = new mysqli('localhost','root','','db-vote');
    mysqli_set_charset($conn,'utf8');
    if(!$conn){
        die("Is not Connected");
    }

?>