<?php 
session_start();
require_once './commons/helpers.php';

require_once './vendor/autoload.php';


// bắt buộc require sau autoload
require_once './commons/database.php';

use Commons\Routing;


$url = isset($_GET['url']) == true ? $_GET['url'] : "/";

Routing::index(trim($url));

 ?>