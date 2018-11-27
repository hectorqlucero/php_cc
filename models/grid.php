<?php
/**
 * Craeate json for easyui grids
 *
 * Avoid having to retype repetitive code when creating grids
 *
 * Grid example:
 * Flight::route('POST /enternamiento/rodadas/json/grid',function() {
 *   $db = Flight::db();
 *   $sql = <<<SQL
 * SELECT
 * id,
 * descripcion_corta,
 * descripcion,
 * punto_reunion,
 * DATE_FORMAT(fecha,'%m/%d/%Y') as fecha,
 * TIME_FORMAT(hora,'%h:%i %p') as hora,
 * leader
 * FROM rodadas
 * SQL;
 *   $search_fields = ['id',
 *                     'descripcion_corta',
 *                     'descripcion',
 *                     'punto_reunion',
 *                     'DATE_FORMAT(fecha,\'%m/%d/%Y\')',
 *                     'TIME_FORMAT(hora,\'%h:%i %p\')',
 *                     'leader'];
 *   $default_order = " ORDER BY fecha,hora";
 *   $request = Flight::request();
 *   $data = grid_rows($db, $sql, $search_fields, $default_order, $request);
 *   echo Flight::json($data);
 * });
 *
 * For debugging:
 * $sql = grid_sql($sql, $search_fields, $default_order, $request);
 *
 *@author Hector Lucero Quihuis
 *@version 1.0.0
 */

/**
 * COALESCE fields to allow proper searching
 * @param $fields array ex: $search_fields = ['id','descripcion',...]
 */
function convert_search_columns($fields) {
    $pfields = "";
    $sep = "";
    foreach($fields as $field => $value) {
        $pfields.=$sep."COALESCE(".$value.",'')";
        $sep = ",";
    }
    return $pfields;
}

/**
 * Create search string over all fields allowed to be searched
 * @param $search string ex: $request->data->search
 * @param $fields array ex: $search_fields = ['id','descripcion',...]
 */
function grid_search($search,$fields) {
    $search_string = NULL;
    if($search) {
        $search_string = " WHERE LOWER(CONCAT(";
        $converted_fields = convert_search_columns($fields);
        $search_string.= $converted_fields.")) like lower('%".$search."%')";
    }
    return $search_string;
}

/**
 * Create ORDER BY string
 * @param $sort string ex: $request->data->sort
 * @param $order string ex: $request->data->order
 * @param $default string ex: $default_order = " ORDER BY fecha,hora"
 */
function grid_order($sort,$order,$default) {
    $sql_order = "";
    if($sort) {
        $sql_order.= " ORDER BY ".$sort." ".$order;
    } else {
        $sql_order = $default;
    }
    return $sql_order;
}

/**
 * Create LIMIT string
 * @param $rows string ex: $request->data->rows
 * @param $page string ex: $request->data->page
 */
function grid_limit($rows,$page) {
    $page = $page - 1;
    $limit = NULL;
    if($rows) {
        if($page >= 0) {
            $page = $rows * $page;
            $limit = " LIMIT ".$rows." OFFSET ".$page;
        }
    }
    return $limit;
}

/**
 * Create sql string
 * @param $sql string ex: $sql = "SELECT id,descripcion,... FROM rodadas";
 * @param $search_fields array ex: $search_fields['id','descripcion',...];
 * @param $default_order string ex: $default_order = " ORDER BY fecha,hora";
 * @param $request array ex: Flight::request();
 */
function grid_sql($sql, $search_fields, $default_order, $request) {
    $sql_search = grid_search($request->data->search, $search_fields);
    $sql_order = grid_order($request->data->sort, $request->data->order, $default_order);
    $sql_limit = grid_limit($request->data->rows, $request->data->page);
    if($sql_search) $sql.=$sql_search;
    if($sql_order) $sql.=$sql_order;
    if($sql_limit) $sql.=$sql_limit;
    return $sql;
}

/**
 * Create rows
 * @param $db object ex: $db = Flight::db();
 * @param $sql string ex: $sql = "SELECT id,descripcion,... FROM rodadas";
 * @param $search_fields array ex: $search_fields['id','descripcion',...];
 * @param $default_order string ex: $default_order = " ORDER BY fecha,hora";
 * @param $request array ex: Flight::request();
 */
function grid_rows($db, $sql, $search_fields, $default_order, $request) {
    $gsql = grid_sql($sql, $search_fields, $default_order, $request);
    $stmt = $db->query($gsql);
    $rows = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($rows, $row);
    }
    $t_stmt = $db->query($sql);
    $total = $t_stmt->rowCount();
    $data = array('rows' => $rows, 'total' => $total);
    return $data;
}
