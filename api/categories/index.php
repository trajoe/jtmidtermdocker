<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

include once '../../config/Database.php';
    include once '../../models/Category.php';
    include once '../../models/Author.php';
    include once '../../functions/isValid.php';
    include once '../../functions/fail.php';
    include once '../../functions/missingParams.php';
    include once '../../functions/notFound.php';
    include once '../../functions/success.php';


    //connect and instantiate db object

    $database = new Database();
    $db = $database->connect();

    $cat = new Category($db);

    //data from user

    $data = json_decode(file_get_contents('php://input'));