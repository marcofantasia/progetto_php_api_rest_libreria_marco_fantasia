


<?php


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");


include_once 'config/database.php';
include_once 'models/libro.php';



$database = new Database();
$db = $database->getConnection();

$libro = new Libro($db);


$stmt = $libro->read();
$num = $stmt->rowCount();

if($num>0){
   
    $libri_arr = array();
    $libri_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $libro_item = array(
            "titolo" => $titolo,
            "autore" => $autore,
            "anno_pubblicazione" => $anno_pubblicazione
        );
        array_push($libri_arr["records"], $libro_item);
    }
    echo json_encode($libri_arr);
}else{
    echo json_encode(
        array("message" => "Nessun Libro Trovato.")
        
    );
}



?>

