<?php

Flight::route('GET /admin/users', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $user = Flight::get('user');
        if (empty($user)) {
            $user = "Anonimo";
        }

        $site_name = Flight::get('site_name');
        Flight::render('header', array('site' => $site_name,'user' => $user), 'header_content');
        Flight::render('menu', array('base_url' => $base_url), 'menu_content');
        Flight::render('admin_menu', array(), 'admin_menu_content');
        Flight::render('user', array('base_url' => $base_url), 'body_content');
        Flight::render('foot', array('foot' => "LS Systems"), 'footer_content');
        Flight::render('layout', array('title' => 'Usuarios', 'base_url' => $base_url));
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('POST /admin/users/json/grid', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $sql = <<<SQL
SELECT
id,
username,
password,
firstname,
lastname,
DATE_FORMAT(dob,'%m/%d/%Y') as dob,
cell,
phone,
fax,
email,
level,
CASE WHEN level = 'A' THEN 'Administrador' ELSE 'Usuario' END as level,
CASE WHEN active = 'T' THEN 'Activo' ELSE 'Inactivo' END as active
FROM users
SQL;
        $search_fields = ['username',
            'lastname',
            'firstname',
            'DATE_FORMAT(dob,\'%m/%d/%Y\')',
            'cell',
            'phone',
            'fax',
            'email',
            'CASE WHEN level = "A" THEN "Administrador" ELSE "Usuario" END',
            'CASE WHEN active = "T" THEN "Activo" ELSE "Inactivo" END'];
        $default_order = " ORDER BY lastname,firstname";
        $request = Flight::request();
        $data = grid_rows($db, $sql, $search_fields, $default_order, $request);
        echo Flight::json($data);
    } else {
        Flight::redirect($base_url);
    }
});

Flight::route('GET /admin/users/json/form/@id', function ($id) {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $sql = <<<SQL
SELECT
id,
lastname,
firstname,
username,
password,
DATE_FORMAT(dob,'%m/%d/%Y') as dob,
cell,
phone,
fax,
email,
level,
active
FROM users
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

function cleanup_phone($phone)
{
    if ($phone == '(___) ___-____') {
        $phone = null;
    }
    return $phone;
}

Flight::route('POST /admin/users/save', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $db = Flight::db();
        $errorMsg = array();
        $request = Flight::request();
        $errorMsg = array('errorMsg' => 'No se pudo crear o actualizar el record!');
        if (isset($request)) {
            $table = "users";
            $lastname = ucwords(strtolower($request->data->lastname));
            $firstname = ucwords(strtolower($request->data->firstname));
            $username = $request->data->username;
            if (strlen($request->data->password) > 55) {
                $password = $request->data->password;
            } else {
                $password = password_hash($request->data->password, PASSWORD_DEFAULT);
            }
            $dob = date('Y-m-d', strtotime($request->data->dob));
            $cell = cleanup_phone($request->data->cell);
            $phone = cleanup_phone($request->data->phone);
            $fax = cleanup_phone($request->data->fax);
            $email = $request->data->email;
            $level = $request->data->level;
            $active = ($request->data->active == 'T' ? 'T' : 'F');
            $data = array(
                "lastname" => $lastname,
                "firstname" => $firstname,
                "username" => $username,
                "password" => $password,
                "dob" => $dob,
                "cell" => $cell,
                "phone" => $phone,
                "fax" => $fax,
                "email" => $email,
                "level" => $level,
                "active" => $active);
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

Flight::route('POST /admin/users/delete', function () {
    $base_url = Flight::get('flight.base_url');
    if (Flight::get('user')) {
        $errorMsg = array('errorMsg' => 'No se pudo remover el record!');
        $db = Flight::db();
        $request = Flight::request();
        if (isset($request)) {
            $table = "users";
            $id_name = "id";
            $id = $request->data->id;
            if (Delete($db, $table, $id_name, $id) >= 0) {
                $errorMsg = array('success' => 'Record removiddo con exito!');
            }
        }
        echo Flight::json($errorMsg);
    } else {
        Flight::redirect($base_url);
    }
});
