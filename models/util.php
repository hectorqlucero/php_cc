<?php

function util_purge_rodadas()
{
    $ccdb = Flight::db();
    try {
        $sql = "DELETE FROM rodadas WHERE fecha < CURRENT_DATE() AND repetir != 'T'";
        $ccdb->exec($sql);
    } catch (PDOException $ex) {
        echo "Ocurrio un Error!";
    }
}

function util_purge_detail()
{
    $ccdb = Flight::db();
    $purgeKeys = "";
    try {
        $sql = "SELECT id FROM rodadas where fecha < CURRENT_DATE()";
        $stmt = $ccdb->prepare($sql);
        if ($stmt->execute()) {
            $sep = "";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $purgeKeys . $sep . $row["id"];
                $sep = ',';
            }
        }
        if ($purgeKeys != "") {
            $sql = "DELETE from rodadas_link where rodadas_id IN({$purgeKeys})";
            try {
                $ccdb->exec($sql);
            } catch (PDOException $ex) {
                echo "Ocurrio un Error!";
            }
        }
    } catch (PDOException $ex) {
        echo "Ocurrio un Error!";
    }
}

function util_repeat_event()
{
    util_purge_detail();
    $ccdb = Flight::db();
    try {
        $sql = "UPDATE rodadas SET fecha = DATE_ADD(fecha,INTERVAL 7 DAY) WHERE fecha < CURRENT_DATE()";
        $ccdb->exec($sql);
    } catch (PDOException $ex) {
        echo "Ocurrio un Error!";
    }
}

function util_process_confirmados($rodadasId)
{
    $ccdb = Flight::db();
    $emails = "ninguno";
    $sep = "";
    try {
        $sql = "SELECT email from rodadas_link WHERE rodadas_id = :rodadas_id";
        $stmt = $ccdb->prepare($sql);
        $stmt->bindParam("rodadas_id", $rodadasId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $emails .= $sep . $row["email"];
                $sep = ",";
            }
        }
    } catch (PDOException $ex) {
        echo "Ocurrio un Error!";
    }
    return $emails;
}

function util_cleanup_phone($phone)
{
    if ($phone == '(___) ___-____') {
        $phone = null;
    }
    return $phone;
}
