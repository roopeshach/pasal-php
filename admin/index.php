<?php

include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

include "inc/conn.php";

include "inc/header.php";

include "inc/footer.php";
