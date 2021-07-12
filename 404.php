<?php 
//print_r($_SERVER);
header('Location: '. $_SERVER['REQUEST_SCHEME'].'://'.  $_SERVER['HTTP_HOST'] .'/index.php');
