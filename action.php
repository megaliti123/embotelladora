<?php
session_start();
date_default_timezone_set('America/Caracas');

$record_per_page=10;
$page = '';

if(isset($_POST['page'])){
    $page = $_POST['page'];
}else{
    $page = 1;  
}

$start_from = ($page - 1) * $record_per_page;

require "php/conexion.php";


if(isset($_POST["action"])){

    if($_POST["action"]=="joder"){

        $Cedula_Login = $_POST["Cedula_Login"];
        $Contra_Login = $_POST["Contra_Login"];

        $pdo= $conectar->prepare ("SELECT * FROM admins where cedula = '$Cedula_Login' and contra = '$Contra_Login'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            $_SESSION['usuario']=$Cedula_Login;
            echo 'Continuar';

        }else{
            echo 'Error';
        }
    }

    if($_POST["action"]=="fetch"){
        $output = '
        <table class="table table-bordered table-striped" style="font-size:14px">
            <tr>
                <th>Cantidad de Botellones</th>
                <th>Litros por Botellon</th>
                <th>Total de Litros</th>
                <th>Ciudad de la recarga</th>
                <th>Hora de la recarga</th>
                <th>Nombre del cliente</th>
                <th>Nombre del cajero</th>
            </tr>
        ';
        $query = "SELECT * FROM botellones ORDER BY hora_botellones DESC LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if($result){
            foreach($result as $row){
                $pdo_cliente = $conectar->prepare ("SELECT * FROM clientes where cedula = $row[cliente_botellon]");
                $pdo_cliente->execute();
                $cliente = $pdo_cliente->fetchAll();
                foreach($cliente as $row_2){
                    $pdo_admin = $conectar->prepare ("SELECT * FROM admins where cedula = $row[admin_botellon]");
                    $pdo_admin->execute();
                    $admin = $pdo_admin->fetchAll();
                    foreach($admin as $row_3){


                $output .='
                    <tr>
                        <td>'.$row['cantidad_botellones'].'</td>
                        <td>'.$row['litros_por_botellon'].'</td>                        
                        <td>'.$row['total_litros_botellones'].'</td>                        
                        <td>'.$row['zona_botellon'].'</td>                        
                        <td>'.$row['hora_botellones'].'</td>              
                        <td>'.$row_2['nombre'].'</td>
                        <td>'.$row_3['nombre'].'</td>      
                    </tr>
                ';
            }
        }   
        }
        }else{
            $output .='
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .='</table>';
        $page_query = "SELECT * FROM botellones ORDER BY hora_botellones DESC";
        $page_result = $conectar->query($page_query);
        $total_record =$page_result->rowCount();
        $total_pages = ceil($total_record/$record_per_page);

        for($i=1; $i<=$total_pages; $i++){ 
            $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id= "'.$i.'">'.$i.'</span>';
        }
        echo $output;
    }

    if($_POST["action"]=="Cliente"){

        $Cedula = $_POST["Cedula"];
        $Nombre = $_POST["Nombre"];
        $Correo = $_POST["Correo"];
        $Telefono = $_POST["Telefono"];
        $Direccion = $_POST["Direccion"];
       
       
        $pdo= $conectar->prepare ("SELECT cedula FROM clientes where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            echo 'Ya existe el usuario';
        }else{

        try{
            $pdo= $conectar->prepare ("INSERT INTO clientes (cedula,nombre,correo,telf,direccion) 
            VALUES (?,?,?,?,?)");
                    $pdo->bindParam(1,$Cedula);
                    $pdo->bindParam(2,$Nombre);
                    $pdo->bindParam(3,$Correo);
                    $pdo->bindParam(4,$Telefono);
                    $pdo->bindParam(5,$Direccion);
            
            $pdo->execute(); 
            echo 'Se insertaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }
    }}
    if($_POST["action"]=="Admin"){

        $Cedula = $_POST["Cedula"];
        $Nombre = $_POST["Nombre"];
        $Correo = $_POST["Correo"];
        $Telefono = $_POST["Telefono"];
        $Direccion = $_POST["Direccion"];
        $Contra = $_POST["Contra"];

        $pdo= $conectar->prepare ("SELECT cedula FROM admins where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            echo 'Ya existe el usuario';
        }else{

        try{
            $pdo= $conectar->prepare ("INSERT INTO admins (cedula,nombre,correo,telf,direccion,contra) 
            VALUES (?,?,?,?,?,?)");
                    $pdo->bindParam(1,$Cedula);
                    $pdo->bindParam(2,$Nombre);
                    $pdo->bindParam(3,$Correo);
                    $pdo->bindParam(4,$Telefono);
                    $pdo->bindParam(5,$Direccion);
                    $pdo->bindParam(6,$Contra);
            
            $pdo->execute(); 
            echo 'Se insertaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }
    }


}

    if($_POST["action"]=="datos_cliente"){

        $Cedula = $_POST["Cedula"];

        $pdo= $conectar->prepare ("SELECT cedula FROM clientes where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            $pdo= $conectar->prepare ("SELECT nombre FROM clientes where cedula = '$Cedula'");
            $pdo->execute(); 
            $result = $pdo->fetchColumn();  

            echo 'El usuario tiene el nombre de: '.$result.'';
        }else{
            echo 'No existe el usuario';
        }

    }

    if($_POST["action"]=="Seguir"){

        $Cedula = $_POST["Cedula"];

        $pdo= $conectar->prepare ("SELECT cedula FROM clientes where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if($result>0){
            echo 'Continuar';
        }else{
            echo 'No existe el usuario';
        }

    }

    if($_POST["action"]=="Añadir"){

        $cantidad_botellones = $_POST["cantidad_botellones"];
        $litros_por_botellon = $_POST["litros_por_botellon"];
        $total_litros_botellones = $cantidad_botellones * $litros_por_botellon;
        $zona_botellon = $_POST["zona_botellon"];
        $date = date('Y-m-d H:i:s');
        $Cedula = $_POST["Cedula"];
        $Cedula_2 = $_POST["Cedula_2"];


        try{
            $pdo= $conectar->prepare ("INSERT INTO botellones (cantidad_botellones,litros_por_botellon,total_litros_botellones,zona_botellon,hora_botellones,cliente_botellon,admin_botellon) 
            VALUES (?,?,?,?,?,?,?)");   
                    $pdo->bindParam(1,$cantidad_botellones);
                    $pdo->bindParam(2,$litros_por_botellon);
                    $pdo->bindParam(3,$total_litros_botellones);
                    $pdo->bindParam(4,$zona_botellon);
                    $pdo->bindParam(5,$date);
                    $pdo->bindParam(6,$Cedula);
                    $pdo->bindParam(7,$Cedula_2);
            
            $pdo->execute(); 
            echo 'Se insertaron los datos correctamente';
        }
        catch(PDOException $error){
            echo 'Error';

        }
    }   
}



?>