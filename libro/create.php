<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/libro.php';
 
$database = new Database();
$db = $database->getConnection();
$libro = new Libro($db);
$data = json_decode(file_get_contents("php://input"));


if(
    !empty($data->titolo) &&
    !empty($data->autore) &&
    !empty($data->anno_pubblicazione) &&
    !empty($data->scadenza)
){
    $libro->titolo = $data->titolo;
    $libro->autore = $data->autore;
    $libro->anno_pubblicazione = $data->anno_pubblicazione;
    $libro->scadenza = $data->scadenza;
 
    if($libro->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Libro creato correttamente."));
    }
    else{
        
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile creare il libro."));
    }
}
else{
    
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare il libro, i dati sono incompleti."));
}

$conn = null;
?>