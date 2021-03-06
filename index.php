<?php

require 'includes/funcionesUsuarios.php';
include ('includes/funciones.php');
include ('includes/funcionesReferencias.php');

$serviciosUsuarios = new ServiciosUsuarios();
$serviciosReferencias = new ServiciosReferencias();
$servicios = new Servicios();



?>
<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Acceso Restringido: Declaraciones Patrimoniales</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
      <script type="text/javascript">
		
			$(document).ready(function(){

					$("#email").click(function(event) {
        			$("#email").removeClass("alert alert-danger");
					$("#email").attr('placeholder','Ingrese el CURP');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert alert-danger");
        			$("#email").attr('placeholder','Ingrese el CURP');
        			});
					
					
					$("#pass").click(function(event) {
        			$("#pass").removeClass("alert alert-danger");
					$("#pass").attr('placeholder','Ingrese el password');
        			});

        			$("#pass").change(function(event) {
        			$("#pass").removeClass("alert alert-danger");
        			$("#pass").attr('placeholder','Ingrese el password');
        			});
					

					
			
				
				$('body').keyup(function(e) {
					if(e.keyCode == 13) {
						$("#login").click();
					}
				});
				
				
				$("#login").click(function(event) {
        			

						$.ajax({
                        data:  {email:		$("#email").val(),
						pass:		$("#pass").val(),
						accion:		'login'},
                        url:   'ajax/ajax.php',
                        type:  'post',
                        beforeSend: function () {
                                $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                        },
                        success:  function (response) {
								
                                if (response != '') {
                                    
                                    $("#error").removeClass("alert alert-danger");

                                    $("#error").addClass("alert alert-danger");
                                    $("#error").html('<strong>Error!</strong> '+response);
                                    $("#load").html('');

                                } else {
							url = "dashboard/";
							$(location).attr('href',url);
						}
                                
                        }
            });
        				
        });
				
			});/* fin del document ready */
		
		</script>


        
        
</head>



<body>


<div class="content">

<!--<div class="row" style="margin-top:10px; font-family:Verdana, Geneva, sans-serif;" align="center">
		<img src="imagenes/logo.png" width="300" height="273">
   
</div>-->


<div class="logueo" align="center">
<br>
<br>
<br>
	<section style="width:700px; padding-top:10px; padding-top:60px;padding:25px;
background-color: #ffffff; border:1px solid #101010; box-shadow: 2px 2px 3px #333;-webkit-box-shadow: 2px 2px 3px #333;-moz-box-shadow: 2px 2px 3px #333;">
			<div id="error" style="text-align:left; color:#666;">
            
            </div>

            <div align="center">
            	<img src="imagenes/logo_cara.png" width="22%">
				<div align="center"><p style="color:#363636; font-size:28px;">Acceso al panel de control</p></div>
                <br>
            </div>
			<form role="form" class="form-horizontal">
              

              <div class="form-group">
                <label for="usuario" class="col-md-2 control-label" style="color:#363636;text-align:left;">CURP</label>
                <div class="col-lg-7">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" id="email" name="email" 
                         placeholder="CURP">
                </div>
                </div>
              </div>

              <div class="form-group">
                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#363636;text-align:left;">Contraseña</label>
                <div class="col-lg-7">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                  <input type="password" class="form-control" id="pass" name="pass" 
                         placeholder="password">
                </div>
                </div>
              </div>
              
              
              
              
              <div class="form-group">
              	<label for="olvido" class="control-label" style="color:#363636">¿Has olvidado tu contraseña?. <a href="recuperarpasswor.php">Recuperar.</a></label>
              </div>
             
              <div class="form-group">
                <div class="col-md-12">
                  <button type="button" class="btn btn-default" id="login">Login</button>
                </div>
              </div>
				
                <div id="load">
                
                </div>

            </form>

     </section>
     <br>
     <br>
     <br>
     </div>
</div><!-- fin del content -->



</body>

</html>