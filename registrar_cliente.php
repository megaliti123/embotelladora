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

      <h1>Ingrese los datos para registrar al cliente</h1> <br><br>

      <form class="">
         <div class="form-group">
            <label for="Cedula" style="font-size:20px">Cédula</label>
            <input type="number" style="font-size:20px" class="form-control form-control-lg" id="Cedula" placeholder="24875002">

            <label for="Nombre" style="font-size:20px">Nombre</label>
            <input type="text" class="form-control form-control-lg" style="font-size:20px" id="Nombre" placeholder="Pedro Picapiedra">

            <label for="Correo" style="font-size:20px">Correo</label>
            <input type="email" class="form-control form-control-lg" style="font-size:20px" id="Correo" placeholder="ejemplo@gmail.com">

            <label for="Telefono" style="font-size:20px">Teléfono</label>
            <input type="number" class="form-control form-control-lg" style="font-size:20px" id="Telefono" placeholder="04249666128">

            <label for="Direccion" style="font-size:20px">Dirección</label>
            <input type="text" class="form-control form-control-lg" style="font-size:20px" id="Direccion" placeholder="Avenida Delicias">
         </div>
         <input type="hidden" name="action" id="action">
         <input type="button" name="crear_cliente" id="crear_cliente" class="btn btn-info" value="Añadir Cliente">
      </form>



</section>


<footer class="footer">

   &copy; Todos los derechos reservado por <span>Suministro de agua purrica</span> | 2023 all rights reserved!

</footer>
<script src="js/home.js"></script>

<script>
   $(document).ready(function(){


      $(document).on('click','#crear_cliente',function(){
            $('#action').val('Cliente');
            var Cedula= $('#Cedula').val();
            var Nombre= $('#Nombre').val();
            var Correo= $('#Correo').val();
            var Telefono= $('#Telefono').val();
            var Direccion= $('#Direccion').val();
            var action = $('#action').val();
            if(Cedula != ''|| Nombre != ''|| Correo != ''|| Telefono != '' || Direccion != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{Cedula:Cedula,Nombre:Nombre,Correo:Correo,Telefono:Telefono,Direccion:Direccion,action:action},
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