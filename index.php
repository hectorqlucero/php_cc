<?php
require 'flight/Flight.php';

require_once 'config/config.php';

date_default_timezone_set('America/Los_Angeles');

session_start();


//start user logged on
$user = NULL;
if(isset($_SESSION['user_id'])) {
    $db = Flight::db();
    $id = $_SESSION['user_id'];
    $sql = "SELECT CONCAT(firstname,' ',lastname) as username FROM users where id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row) {
        $user = $row['username'];
    }
}
Flight::set('user', $user);
//end user logged on

//start models
require_once 'models/crud.php';
require_once 'models/grid.php';
require_once 'models/util.php';
//end models

//start controllers
require_once 'controllers/home.php';
require_once 'controllers/users.php';
require_once 'controllers/rodadas.php';
require_once 'controllers/cuadrantes.php';
//end controllers

Flight::start();
