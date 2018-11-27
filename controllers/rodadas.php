<?php

Flight::route('GET /entrenamiento/rodadas', function () {
    $base_url = Flight::get('flight.base_url');
    $user = Flight::get('user');
    if (empty($user)) {
        $user = "Anonimo";
    }

    $site_name = Flight::get('site_name');
    Flight::render('header', array('site' => $site_name, 'user' => $user), 'header_content');
    Flight::render('menu', array('base_url' => $base_url), 'menu_content');
    Flight::render('admin_menu', array(), 'admin_menu_content');
    Flight::render('rodadas', array('base_url' => $base_url), 'body_content');
    Flight::render('foot', array('foot' => "LS Systems"), 'footer_content');
    Flight::render('layout', array('title' => 'Entrenamiento', 'base_url' => $base_url));
});

Flight::route('POST /entrenamiento/rodadas/json/grid', function () {
    $db = Flight::db();
    $sql = <<<SQL
SELECT
id,
descripcion_corta,
descripcion,
punto_reunion,
DATE_FORMAT(fecha,'%m/%d/%Y') as fecha,
TIME_FORMAT(hora,'%h:%i %p') as hora,
leader,
repetir
FROM rodadas
SQL;
    $search_fields = ['descripcion_corta',
        'punto_reunion',
        'DATE_FORMAT(fecha,\'%m/%d/%Y\')',
        'TIME_FORMAT(hora,\'%h:%i %p\')',
        'leader'];
    $default_order = " ORDER BY fecha,hora";
    $request = Flight::request();
    $data = grid_rows($db, $sql, $search_fields, $default_order, $request);
    echo Flight::json($data);
});

Flight::route('GET /entrenamiento/rodadas/json/form/@id', function ($id) {
    $base_url = Flight::get('flight.base_url');
    $db = Flight::db();
    $sql = <<<SQL
SELECT
id,
descripcion,
descripcion_corta,
punto_reunion,
DATE_FORMAT(fecha,'%m/%d/%Y') as fecha,
TIME_FORMAT(hora, '%H:%i') as hora,
leader,
leader_email,
repetir
FROM rodadas
where id = :id
SQL;
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row, JSON_NUMERIC_CHECK);
});

Flight::route('POST /entrenamiento/rodadas/save', function () {
    $base_url = Flight::get('flight.base_url');
    $db = Flight::db();
    $errorMsg = array();
    $request = Flight::request();
    $errorMsg = array('errorMsg' => 'No se pudo crear o actualizar el record!');
    if (isset($request)) {
        $id = $request->data->id;
        $descripcion = $request->data->descripcion;
        $descripcion_corta = $request->data->descripcion_corta;
        $punto_reunion = $request->data->punto_reunion;
        $fecha = date('Y-m-d', strtotime($request->data->fecha));
        $hora = $request->data->hora;
        $leader = $request->data->leader;
        $leader_email = $request->data->leader_email;
        $repetir = $request->data->repetir;
        $table = "rodadas";
        $data = array(
            "descripcion" => $descripcion,
            "descripcion_corta" => $descripcion_corta,
            "punto_reunion" => $punto_reunion,
            "fecha" => $fecha,
            "hora" => $hora,
            "leader" => $leader,
            "leader_email" => $leader_email,
            "repetir" => $repetir);
        $id_name = "id";
        if (Save($db, $table, $data, $id_name, $id) >= 0) {
            $errorMsg = array('success' => 'El record se actualizo apropiadamente!');
        }
    }
    echo Flight::json($errorMsg);
});

Flight::route('POST /entrenamiento/rodadas/delete', function () {
    $db = Flight::db();
    $errorMsg = array();
    $request = Flight::request();
    $errorMsg = array('errorMsg' => 'No se pudo remover el record!');
    if (isset($request)) {
        $table = "rodadas";
        $id_name = "id";
        $id = $request->data->id;
        if (Delete($db, $table, $id_name, $id) >= 0) {
            $errorMsg = array('success' => 'Record removido con exito!');
        }
    }
    echo Flight::json($errorMsg);
});
