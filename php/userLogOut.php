<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	
	if ($_SESSION['auth']) {
		unset($_SESSION['user']);
		$_SESSION['auth'] = false;
		setcookie('Key', '', time());

		$response = [
			'status' => true
		];

		echo json_encode($response);
	}
}
else {
    header('Location: welcoming.php');
}


