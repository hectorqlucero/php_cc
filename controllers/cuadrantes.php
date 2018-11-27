<?php

Flight::route('GET /admin/cuadrantes', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $user = Flight::get('user');
        if (empty($user)) {
            $user = "Anonimo";
        }

        $site_name = Flight::get('site_name');
        Flight::render('header', array('site' => $site_name, 'user' => $user), 'header_content');
        Flight::render('menu', array('base_url' => $base_url), 'menu_content');
        Flight::render('admin_menu', array(), 'admin_menu_content');
        Flight::render('cuadrantes', array('base_url' => $base_url), 'body_content');
        Flight::render('foot', array('foot' => "LS Systems"), 'footer_content');
        Flight::render('layout', array('title' => 'Admin', 'base_url' => $base_url));
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('POST /admin/cuadrantes/json/grid', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $sql = <<<SQL
SELECT
id,
name,
leader,
leader_phone,
leader_cell,
leader_email,
notes,
CASE WHEN status = "T" THEN "Activo" WHEN status = "F" THEN "Inactivo" ELSE "??" END as status
FROM cuadrantes
SQL;
        $search_fields = ['name',
            'leader',
            'leader_phone',
            'leader_cell',
            'leader_email'];
        $default_order = " ORDER BY name";
        $request = Flight::request();
        $data = grid_rows($db, $sql, $search_fields, $default_order, $request);
        echo Flight::json($data);
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('GET /admin/cuadrantes/json/form/@id', function ($id) {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $sql = <<<SQL
SELECT
id,
name,
leader,
leader_phone,
leader_cell,
leader_email,
notes,
status
FROM cuadrantes
where id = :id
SQL;
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row, JSON_NUMERIC_CHECK);
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('POST /admin/cuadrantes/save', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $request = Flight::request();
        $errorMsg = array();
        $errorMsg = array('errorMsg' => 'No se pudo crear o actualizar el record!');
        if (isset($request)) {
            $name = $request->data->name;
            $leader = $request->data->leader;
            $leader_phone = util_cleanup_phone($request->data->leader_phone);
            $leader_cell = util_cleanup_phone($request->data->leader_cell);
            $leader_email = $request->data->leader_email;
            $notes = $request->data->notes;
            $status = $request->data->status;
            $table = "cuadrantes";
            $data = array(
                "name" => $name,
                "leader" => $leader,
                "leader_phone" => $leader_phone,
                "leader_cell" => $leader_cell,
                "leader_email" => $leader_email,
                "notes" => $notes,
                "status" => $status);
            $id_name = "id";
            $id = $request->data->id;
            if (Save($db, $table, $data, $id_name, $id) >= 0) {
                $errorMsg = array('success' => 'El record se actualizo apropiadamente!');
            }
        }
        echo Flight::json($errorMsg);
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('POST /admin/cuadrantes/delete', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $errorMsg = array();
        $errorMsg = array('errorMsg' => 'No se pudo remover el record!');
        $db = Flight::db();
        $request = Flight::request();
        if (isset($request)) {
            $table = "cuadrantes";
            $id_name = "id";
            $id = $request->data->id;
            if (Delete($db, $table, $id_name, $id) >= 0) {
                $errorMsg = array('success' => 'Record removido con exito!');
            }
        }
        echo Flight::json($errorMsg);
    } else {
        Flight::redirect($base_url);
    }
});
