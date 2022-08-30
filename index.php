<?php

use CRUD_Sample\Controller\PersonController;

include("loader.php");

$controller = new PersonController();
$controller->switcher(str_replace("/CRUD_Sample", "", explode("?", $_SERVER['REQUEST_URI'])[0]), $_REQUEST);
