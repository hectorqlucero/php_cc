<?php

Flight::route('GET /', function () {
    $base_url = Flight::get('flight.base_url');
    Flight::redirect($base_url . 'main');
});

Flight::route('GET /login', function () {
    $base_url = Flight::get('flight.base_url');
    $user = Flight::get('user');
    if (empty($user)) {
        $user = "Anonimo";
    }

    $site_name = Flight::get('site_name');
    Flight::render('header', array('site' => $site_name, 'user' => $user), 'header_content');
    Flight::render('menu', array('base_url' => $base_url), 'menu_content');
    Flight::render('admin_menu', array(), 'admin_menu_content');
    Flight::render('login', array(), 'body_content');
    Flight::render('foot', array('foot' => "LS Systems"), 'footer_content');
    Flight::render('layout', array('title' => 'Calendar', 'base_url' => $base_url));
});

Flight::route('POST /login', function () {
    $url = Flight::get('flight.base_url') . 'main';
    $db = Flight::db();
    $request = Flight::request();
    $username = $request->data->username;
    $password = $request->data->password;
    $sql = "SELECT id,username,password FROM users where username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $errorMsg = array('error' => 'no se pudo accessar el sitio!');
    if ($row) {
        $hash = $row['password'];
        $pass = password_verify($password, $hash);
        if ($pass) {
            $_SESSION['user_id'] = $row['id'];
            $errorMsg = array('success' => 'Usuario correcto - adelante!', 'url' => $url);
        }
    }
    Flight::json($errorMsg);
});

Flight::route('GET /main', function () {
    $base_url = Flight::get('flight.base_url');
    $db = Flight::db();
    $user = Flight::get('user');
    if (empty($user)) {
        $user = "Anonimo";
    }

    $site_name = Flight::get('site_name');
    //Purge expired records
    util_purge_rodadas();
    //Repeat events
    util_repeat_event();
    $sql = "SELECT id,descripcion_corta as title,descripcion as descripcion,CONCAT(fecha,'T',hora) as start,punto_reunion as donde,leader as leader,leader_email as email,CONCAT('/entrenamiento/rodadas') as url FROM rodadas ORDER BY fecha,hora";
    $stmt = $db->query($sql);
    Flight::render('header', array('site' => $site_name, 'user' => $user), 'header_content');
    Flight::render('menu', array('base_url' => $base_url), 'menu_content');
    $events = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($events, $row);
    }
    $eventos = json_encode($events);
    Flight::render('header', array('site' => $site_name, 'user' => $user), 'header_content');
    Flight::render('menu', array('base_url' => $base_url), 'menu_content');
    Flight::render('admin_menu', array(), 'admin_menu_content');
    Flight::render('main_body', array(), 'body_content');
    Flight::render('main', array('title' => 'Calendario de Eventos', 'events' => $eventos), 'script_content');
    Flight::render('foot', array('foot' => "LS Systems"), 'footer_content');
    Flight::render('layout', array('title' => 'Calendario de Eventos', 'base_url' => $base_url));
});

Flight::route('GET /logoff', function () {
    $base_url = Flight::get('flight.base_url');
    session_destroy();
    Flight::redirect($base_url);
});
