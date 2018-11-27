<?php
/**
 * Crud for PDO and MySQL
 *
 * Avoid having to retype repetitive code when executing crud operations
 *
 * Save insert or update ex:
 * $db = Flight::db();
 * $request = Flight::request();
 * $errorMsg = array('errorMsg' => "Unable to process record!");
 * if(isset($request)) {
 *   $table = "rodadas";
 *   $data = array(
 *       "descripcion" => $request->data->descripcion,
 *       "punto_reunion" => $request->data->punto_reunion);
 *   $id_name = "id";
 *   $id = $request->data->id;
 *   if(Save($db, $table, $data, $id_name, $id) >= 0) {
 *     $errorMsg = array('success' => 'Record updated successfully!');
 *   }
 * }
 * echo Flight::json($errorMsg);
 *
 * Insert ex:
 * $db = Flight::db();
 * $request = Flight::request();
 * $errorMsg = array('errorMsg' => "Unable to process record!");
 * if(isset($request)) {
 *   $table = "rodadas";
 *   $data = array(
 *       "descripcion" => $request->data->descripcion,
 *       "punto_reunion" => $request->data->punto_reunion);
 *   if(Insert($db, $table, $data) >= 0) {
 *     $errorMsg = array('success' => 'Record updated successfully!');
 *   }
 * }
 * echo Flight::json($errorMsg);
 *
 * Update ex:
 * $db = Flight::db();
 * $request = Flight::request();
 * $errorMsg = array('errorMsg' => "Unable to process record!");
 * if(isset($request)) {
 *   $table = "rodadas";
 *   $data = array(
 *       "descripcion" => $request->data->descripcion,
 *       "punto_reunion" => $request->data->punto_reunion);
 *   $id_name = "id";
 *   $id = $request->data->id;
 *   if(Update($db, $table, $data, $id_name, $id) >= 0) {
 *     $errorMsg = array('success' => 'Record updated successfully!');
 *   }
 * }
 * echo Flight::json($errorMsg);
 *
 * Delete ex:
 * $errorMsg = array('errorMsg' => "Unable to process record!");
 * $db = Flight::db();
 * $request = Flight::request();
 * if(isset($request)) {
 *   $table = "rodadas";
 *   $id_name = "id";
 *   $id = $request->data->id;
 *   if(Delete($db, $table, $id_name, $id) >= 0) {
 *     $errorMsg = array('success' => 'Record updated successfully!');
 *   }
 * }
 * echo Flight::json($errorMsg);
 *
 *@author Hector Lucero Quihuis
 *@version 1.0.0
 */

/**
 * Create PDO parameters from field names ex. id -> :id
 * @param $field array keys ex. array_keys($data)
 */
function Save_create_values($field) {
    return ":".$field;
}

/**
 * Create an array from two arrays replacing the key with a new key
 * @param $field array keys
 * @param $value array values
 */
function Save_create_array($field, $value) {
    return [":".$field => $value];
}

/**
 * Create an  assoc array from the function "Save_create_array"
 * @param f function "Save_create_array"
 * @param a original array ex. $data
 */
function array_map_assoc(callable $f, array $a) {
    return array_reduce(array_map($f, array_keys($a), $a), function (array $acc, array $a) {
        return $acc + $a;
    }, []);
}

/**
 * Create Insert process to update a MySQL table
 * @param $db database object connection
 * @param $table string table name ex. "rodadas"
 * @param $data array ex. $data = array("descripcion" => $descripcion...)
 */
function Insert($db, $table, $data) {
    $affected_rows = -1;
    try {
        $imploded_keys = implode(', ', array_keys($data));
        $mapped_array = array_map("Save_create_values", array_keys($data));
        $imploded_values = implode(', ', $mapped_array);
        $values_array = array_map_assoc("Save_create_array", $data);
        $sql = "INSERT INTO {$table} (".$imploded_keys.") VALUES(".$imploded_values.")";
        $stmt = $db->prepare($sql);
        if($stmt->execute($values_array)) {
            $affected_rows = $stmt->rowCount();
        }
    } catch(PDOException $ex) {
        //Here you can log errors
        echo "Ocurrio un Error!";
    }
    return $affected_rows;
}

/**
 * Create Update process to update a MySQL table
 * @param $db database object connection
 * @param $table string table name ex. "rodadas"
 * @param $data array ex. $data = array("descripcion" => $descripcion...)
 * @param $id_name string the name of the id field ex. "id"
 * @param $id int the value of the id field ex $id
 */
function Update($db, $table, $data, $id_name, $id) {
    $affected_rows = -1;
    if($id) {
        try {
            $sql = "UPDATE ".$table." SET ";
            $body = implode(', ', array_keys($data));
            $body = str_replace(", ", " = ? ,", $body)." = ?";
            $sql.=$body." WHERE ".$id_name." = ?";
            $values = array_values($data);
            array_push($values, $id);
            $stmt = $db->prepare($sql);
            if($stmt->execute($values)) {
                $affected_rows = $stmt->rowCount();
            }
        } catch(PDOException $ex) {
            //Here you can log errors
            echo "Occurio un Error!";
        }
    }
    return $affected_rows;
}

/**
 * Create Delete process to update a MySQL table
 * @param $db database object connection
 * @param $table string table name ex. "rodadas"
 * @param $id_name string the name of the id field ex. "id"
 * @param $id int the value of the id field ex $id
 */
function Delete($db, $table, $id_name, $id) {
    $affected_rows = -1;
    try {
        $sql = "DELETE FROM ".$table." WHERE ".$id_name." = :".$id_name;
        $stmt = $db->prepare($sql);
        $stmt->bindParam($id_name, $id, PDO::PARAM_INT);
        if($stmt->execute()) {
            $affected_rows = $stmt->rowCount();
        }
    } catch(PDOException $ex) {
        //Here you can log errors
        echo "Ocurrio un Error!";
    }
    return $affected_rows;
}

/**
 * Create Update/Insert process to update a MySQL table
 * @param $db database object connection
 * @param $table string table name ex. "rodadas"
 * @param $data array ex. $data = array("descripcion" => $descripcion...)
 * @param $id_name string the name of the id field ex. "id"
 * @param $id int the value of the id field ex $id
 */
function Save($db, $table, $data, $id_name, $id) {
    $affected_rows = -1;
    if($id) {
        $affected_rows = Update($db, $table, $data, $id_name, $id);
    } else {
        $affected_rows = Insert($db, $table, $data);
    }
    return $affected_rows;
}
