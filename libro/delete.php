<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE"); 
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/libro.php';

$database = new Database();
$db = $database->getConnection();

$libro = new Libro($db);

$data = json_decode(file_get_contents("php://input"));

if ($data !== null && !empty($data->titolo)) {
    $libro->titolo = $data->titolo;

    if ($libro->delete($id)) {
        http_response_code(200);
        echo json_encode(array("risposta" => "Il libro è stato eliminato"));
    } else {
        http_response_code(503); // 503 service unavailable
        echo json_encode(array("risposta" => "Impossibile eliminare il libro."));
    }
} else {
    http_response_code(400); // 400 bad request
    echo json_encode(array("risposta" => "Impossibile eliminare il libro, titolo mancante."));
}

$conn = null;

?>

