<?php
    require '../controller/methods.php';
    $meth = new UserMethods;
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if (isset($_GET['name'])) {
                echo $meth -> saveUser($_GET['name'],$_GET['lastname'],$_GET['country'],
                                    $_GET['user'],$_GET['password']);
            } else {
                echo json_encode(array('except'=>'Faltan datos'));
            }
        break;
        case 'GET':
            if(isset($_GET['id'])) {
                echo $meth -> getUserById($_GET['id']);
            } else {
                if (isset($_GET['user'])) {
                    //$_LOG = json_decode(file_get_contents('php://input'), true);
                    echo $meth -> logIn($_GET['user'],$_GET['password']);
                } else {
                    echo $meth -> getUsers();
                }
            }
        break;
        case 'PUT':
            if (isset($_GET['id']) and isset($_GET['name'])) {
                //$_PUT = json_decode(file_get_contents('php://input'), true);
                echo $meth -> editUser($_GET['id'],$_GET['name'],$_GET['lastname'],
                                    $_GET['country'],$_GET['user'],$_GET['password']);
            } else {
                echo json_encode(array('except'=>'Faltan datos'));
            }
        break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                echo $meth -> deleteUser($_GET['id']);
            } else {
                echo json_encode(array('except'=>'Faltan datos'));
            }
        break;
    } 
?>