<?php

require_once 'Model.php';

    class UsuarioModel extends Model 
    {
        function getUsuario($Mail_de_usuario){
            $query= $this->db->prepare('SELECT * FROM usuarios WHERE Mail_de_usuario= ?');
            $query->execute([$Mail_de_usuario]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }
?>