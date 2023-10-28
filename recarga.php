<?php
require "php/conexion.php";
session_start();

/*if(!isset($_SESSION['id'])){
   echo '<script language="javascript">
   window.location = "sexo.php"
   </script>';
   die();
   session_destroy(); 
 }*/

$cedula = $_SESSION['usuario'];
$query = "SELECT * FROM admins WHERE cedula = '$cedula'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Nombre = $row['nombre'];
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <title>Suministro de agua purrica - Inicio</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/  .min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


   <!-- custom css file link  -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.php" class="logo">Suministro de agua purrica</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <!--<div id="toggle-btn" class="fas fa-sun"></div>-->
      </div>

      <div class="profile">
         <img src="images/pic-1.jpg" class="image" alt="">
         <?php echo "<h3 class='name'>$Nombre</h3>" ?>
         <div class="flex-btn">
            <a href="php/salir.php" class="option-btn">Cerrar sesión</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <?php echo "<h3 class='name'>$Nombre</h3>" ?>
      <h3 class='name'>Administrador</h3>
   </div>

   <nav class="navbar">

      <a href='home.php'><i class='fas fa-home'></i><span>Reportes</span></a> 
      <a href='registrar_admin.php'><i class='fa-solid fa-lock'></i><span>Registrar administrador</span></a>
      <a href='registrar_cliente.php'><i class='fa-solid fa-user'></i><span>Registrar Cliente</span></a>
      <a href='recarga.php'><i class='fa-solid fa-cart-shopping'></i><span>Añadir Recarga</span></a>
      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>

</div>


<section class="courses">

      <h1 id="verificar" name="verificar">Ingrese la cedula del cliente</h1> <br><br>

      <form class="cliente" id="cliente">
         <div class="form-group">
            <label for="Cedula" style="font-size:20px">Cédula</label>
            <input type="number" name="Cedula" id="Cedula" style="font-size:20px" class="form-control"> <br>

         </div>

         <input type="button" name="check" id="check" class="btn btn-info" value="Verificar usuario">
         <input type="button" name="continue" id="continue" class="btn btn-info" value="Continuar">
      </form>

      <form class="Mostrar" id="Mostrar">
         <h1 id="verificar" name="verificar">Ingrese los datos requeridos</h1> <br> <br>

         <div class="form-group">
            <label for="cantidad_botellones" style="font-size:20px">Cantidad de botellones:</label>
            <input type="number" name="cantidad_botellones" style="font-size:20px" id="cantidad_botellones" class="form-control"> <br>
            <label for="litros_por_botellon" style="font-size:20px">Litros llenados por botellon:</label>
            <input type="number " name="litros_por_botellon" style="font-size:20px" id="litros_por_botellon" class="form-control"> <br>
            <label for="zona_botellon" style="font-size:20px">Zona del país:</label><br>

            <select class="form-select form-select-lg mb-3" style="font-size:20px" name="zona_botellon" id="zona_botellon"> 
               <option style="font-size:20px" value="Caracas">Caracas</option>
               <option style="font-size:20px" value="Maracaibo">Maracaibo</option>
               <option style="font-size:20px" value="Valencia">Valencia</option>
               <option style="font-size:20px" value="Barquisimeto">Barquisimeto</option>
               <option style="font-size:20px" value="Ciudad Guayana">Ciudad Guayana</option>
               <option style="font-size:20px" value="Mérida">Mérida</option>
               <option style="font-size:20px" value="Puerto la Cruz">Puerto la Cruz</option>
               <option style="font-size:20px" value="San Cristóbal">San Cristóbal</option>
               <option style="font-size:20px" value="Barcelona">Barcelona</option>
            </select>  <br><br>  

            <input type="hidden" name="action" id="action">
            <input type="hidden" name="Cedula_2" id="Cedula_2" value= <?php echo $cedula; ?>>
            <input type="button" name="recarga" id="recarga" class="btn btn-info" value="Añadir Recarga">
      </form>



</section>


<footer class="footer">

   &copy; Todos los derechos reservado por <span>Suministro de agua purrica</span> | 2023 all rights reserved!

</footer>
<script src="js/home.js"></script>


<script>
var verificar = document.querySelector("#verificar");
var el_first = document.querySelector(".cliente");
var el_second = document.querySelector(".Mostrar");
var boton_check = document.querySelector("#check");
var boton_siguiente = document.querySelector("#continue");
var regresar = document.querySelector("#regresar");


el_second.style.display = "none";



   $(document).ready(function(){

      
      $(document).on('click','#check',function(){
            $('#action').val('datos_cliente');
            var Cedula= $('#Cedula').val();
            var action = $('#action').val();
            if(Cedula != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{Cedula:Cedula,action:action},
                    success:function(data)
                    {
                        alert(data);
                    }
                    }
                )

            }else{
                alert("Ingresa todos los datos");
            }

        }); 

        $(document).on('click','#continue',function(){
            $('#action').val('Seguir');
            var Cedula= $('#Cedula').val();
            var action = $('#action').val();
            if(Cedula != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{Cedula:Cedula,action:action},
                    success:function(data)
                    {
                     if(data=="Continuar"){
                        el_first.style.display = "none";
                        verificar.style.display = "none";
                        el_second.style.display = "block";
                     }else if(data=="No existe el usuario"){
                        alert(data);
                     }


                    }
                    }
                )

            }else{
                alert("Ingresa todos los datos");
            }

        }); 

        $(document).on('click','#recarga',function(){
            $('#action').val('Añadir');
            var cantidad_botellones= $('#cantidad_botellones').val();
            var litros_por_botellon= $('#litros_por_botellon').val();
            var zona_botellon= $('#zona_botellon').val();
            var Cedula= $('#Cedula').val();
            var Cedula_2= $('#Cedula_2').val();
            var action = $('#action').val();
            if(cantidad_botellones != ''|| litros_por_botellon != ''|| zona_botellon != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{cantidad_botellones:cantidad_botellones,litros_por_botellon:litros_por_botellon,zona_botellon:zona_botellon,Cedula:Cedula,Cedula_2:Cedula_2, action:action},
                    success:function(data)
                    {
                        alert(data);
                    }
                    }
                )

            }else{
                alert("Ingresa todos los datos");
            }

        });




 });




   
</script>

</body>
</html>