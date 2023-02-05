<?php

require_once('../model/User.php');

if (empty($_SESSION['user']) || !$_SESSION['auth']) {
	
	if (!empty($_COOKIE['Key'])) {
	
		$key = $_COOKIE['Key'];

        $filename = '../users.json';
        if (file_exists($filename)) {
            $dataStringJSON = file_get_contents($filename);
        } else {
            $dataStringJSON = fopen($filename, 'a+');
        }                

        $dataStringJSON = json_decode($dataStringJSON, true);

        foreach ($dataStringJSON as $value) {
            
            if ($value['coockie'] == $key){

                User::formationSession($value['userlogin'], $value['email'], $value['name']);
                header('Location: welcoming.php');
                break;
            }
        }
	} 
} 
else {
    header('Location: welcoming.php');
}