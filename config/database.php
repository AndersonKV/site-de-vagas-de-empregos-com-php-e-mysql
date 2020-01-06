<?php

//connect to database
$conn = mysqli_connect('localhost', 'root', '', 'ex_jobs'); 

//check connectin
if(!$conn) {
	echo 'connection error: ' . mysqli_connect_error();
}

?>