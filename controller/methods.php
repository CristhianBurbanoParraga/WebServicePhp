<?php
    require '../db/config.php';
    class UserMethods {
        function getUsers() {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("SELECT * FROM user ORDER BY id");
            $query -> execute();
            if (!$query) {
                $result = array('except'=>'Error al ejecutar la extraccion de datos');
            } else {
                if ($query -> rowCount() > 0) {
                    $result = $query -> fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = array('except'=>'No hay registros');;
                }
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
        function getUserById($id) {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("SELECT * FROM `user` WHERE id = " . $id);
            $query -> execute();
            if (!$query) {
                $result = array('except'=>'Error al ejecutar la extraccion de datos');
            } else {
                if ($query -> rowCount() > 0) {
                    $result = $query -> fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = array('except'=>'No hay registros con el id: '. $id);
                }
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
        function saveUser($name, $lastname, $country, $user, $password) {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("INSERT INTO `user` (`name`, `lastname`, `country`, `user`, `password`) ". 
            "VALUES ('". $name ."','". $lastname."','". $country .
            "','". $user ."','". $password ."')");
            $query -> execute();
            if ($query) {
                $result = array('method'=>'insert','name'=>$name,'lastname'=>$lastname,'country'=>$country);
            } else {
                $result = array('except'=>'Error al guardar datos');
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
        function editUser($id, $name, $lastname, $country, $user, $password) {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("UPDATE `user` SET `name`='". $name ."',`lastname`='". $lastname ."',
            `country`='". $country ."',`user`='". $user ."',`password`='". $password ."' WHERE id = ". $id);
            $query -> execute();
            if ($query) {
                $result = array('method'=>'update','id'=>$id,'name'=>$name,'lastname'=>$lastname,'country'=>$country);
            } else {
                $result = array('except'=>'Error al modificar datos');
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
        function deleteUser($id) {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("DELETE FROM `user` WHERE id = ". $id);
            $query -> execute();
            if ($query) {
                $result = array('method'=>'delete','id'=>$id);
            } else {
                $result = array('except'=>'Error al eliminar datos');
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
        function logIn($user, $password) {
            $db = new Connect();
            $result = null;
            $query = $db -> prepare("SELECT `id` FROM `user` WHERE `user` LIKE '". 
                                $user ."' AND `password` LIKE '". $password ."'");
            $query -> execute();
            if (!$query) {
                $result = array('except'=>'Error al ejecutar la extraccion de datos');
            } else {
                if ($query -> rowCount() > 0) {
                    $result = $query -> fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $result = array('id'=>0);
                }
            }
            $query = null;
            $db = null;
            return json_encode($result);
        }
    }
?>