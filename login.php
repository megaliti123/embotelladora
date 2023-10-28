<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Ingresa los datos</h5>
            <form>
              <div class="form-floating mb-3">
                <label for="cedula">Cédula</label>
                <input type="number" class="form-control" id="Cedula_Login" name="Cedula_Login" value="29646702"> 
              </div>
              <div class="form-floating mb-3">
                <label for="contra">Contraseña</label>
                <input type="password" class="form-control" id="Contra_Login" name="Contra_Login" value="102030">
              </div>
              <div class="d-grid">
              <input type="hidden" name="action" id="action">
              <input type="button" name="login" id="login" class="btn btn-primary btn-login text-uppercase fw-bold" value="Iniciar sesion">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
   $(document).ready(function(){


      $(document).on('click','#login',function(){
            $('#action').val('joder');
            var Cedula_Login= $('#Cedula_Login').val();
            var Contra_Login= $('#Contra_Login').val();
            var action = $('#action').val();
            if(Cedula_Login != ''|| Contra_Login != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{Cedula_Login:Cedula_Login,Contra_Login:Contra_Login,action:action},
                    success:function(data)
                    {
                      if(data=="Continuar"){
                        window.location.href = "home.php";
                      }else if(data=="Error"){
                        alert("Datos incorrectos")
                      }
                    }
                    }
                )

            }else{
                alert("Ingresa todos los datos");
            }

        }); 


 });




   
</script>
</html>