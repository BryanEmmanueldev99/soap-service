<?php

class Usuario extends Conection
{
    
    public function store($nombre, $apellidos, $correo)
    {
        $cn = parent::conectar_mysql();
        parent::set_Name();
        $sql = "INSERT INTO usuarios (id,nombre,apellidos,correo,estado) 
        VALUES (NULL,?,?,?,'1');";
        $stmp = $cn->prepare($sql);
        $stmp->bindValue(1, $nombre);
        $stmp->bindValue(2, $apellidos);
        $stmp->bindValue(3, $correo);
        $stmp->execute();
    }


}