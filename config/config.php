<?php
Flight::register('db','PDO',array('mysql:host=localhost;dbname=cc;charset=utf8','root','xxxxxx', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, MYSQL_ATTR_INIT_COMMAND => "SET time_zone = 'America/Los_Angeles'")));
Flight::set('flight.views.extension',".html");
Flight::set('flight.base_url','http://localhost/php_cc/');
Flight::set('site_name','Cuadrantes');
