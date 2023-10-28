<?php

try{
    $conectar=new PDO('mysql:host=localhost;port=3306;dbname=agua','root','');
    $conectar->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conectar->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $conectar->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
}


catch(PDOException $error){
    echo $error->getMessage();
    die;

}

?>