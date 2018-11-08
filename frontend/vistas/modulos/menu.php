<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

/*=============================================
INICIO DE SESIÓN USUARIO
=============================================*/

if(isset($_SESSION["validarSesion"])){

	if($_SESSION["validarSesion"] == "ok"){

		echo '<script>

			localStorage.setItem("usuario","'.$_SESSION["id"].'");

		</script>';

	}

}

?>

<nav class="nav content-hidden">

    <div class="icon toggle-btn">
      <div class="hamburger">
      </div>
    </div>
    <ul class="side-nav">

      <li class="nav-item">
          <a href="<?php echo $url;?>" class="site-name">the lash conference</a>
      </li>
    <!--=====================================
      REGISTRO
      ======================================-->

    <?php

          if(isset($_SESSION["validarSesion"])){

            if($_SESSION["validarSesion"] == "ok"){

              if($_SESSION["modo"] == "directo"){

                if($_SESSION["foto"] != ""){

                  echo '<li class="nav-item">

                      <img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">

                     </li>';

                }else{

                  echo '<li class="nav-item">

                    <img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">

                  </li>';

                }

                echo '<li>|</li>
                 <li class="nav-item" ><a class="nav-link" href="'.$url.'perfil">Ver Perfil</a> |
                 <a class="nav-link" href="'.$url.'salir">Salir</a> </li>';


              }

              if($_SESSION["modo"] == "facebook"){

                echo '<li class="nav-item">

                    <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

                     </li>
                     <li>|</li>
                     <li class="nav-item"><a class="nav-link" href="'.$url.'perfil">Ver Perfil</a> |
                     <a class="nav-link" href="'.$url.'salir" class="salir">Salir</a></li>';

              }

              if($_SESSION["modo"] == "google"){

                echo '<li class="nav-item">

                    <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

                     </li>
                     <li class="nav-item"><a class="nav-link" href="'.$url.'perfil">Ver Perfil</a> |
                     <a class="nav-link" href="'.$url.'salir">Salir</a></li>';

              }

            }

          }else{

            echo '<li class="nav-item"><a class="nav-link" href="#modalIngreso" data-toggle="modal">Ingresar</a> |
            <a class="nav-link" href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';

          }

          ?>
		  <div class="carrito" id="carrito">
			  <a href="<?php echo $url;?>carrito-de-compras">
		  		<button>
					  carrito
				  </button>
			  </a>
		  </div>

            <li class="nav-item">
                <a href="<?php echo $url;?>#welcome" class="nav-link">inicio</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $url;?>#modalidades" class="nav-link">competencia</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $url;?>#people" class="nav-link">oradores &amp; jurado</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $url;?>#sponsor" class="nav-link">sponsors</a>
            </li>
        </ul>
</nav>



<!--=====================================
VENTANA MODAL PARA EL REGISTRO
======================================-->

<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">REGISTRARSE</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

			<!--=====================================
			REGISTRO FACEBOOK
			======================================-->

			<div class="col-sm-6 col-xs-12 facebook">

				<p>
				  <i class="fa fa-facebook"></i>
					Registro con Facebook
				</p>

			</div>

			<!--=====================================
			REGISTRO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">

				<div class="col-sm-6 col-xs-12 google">

					<p>
					  <i class="fa fa-google"></i>
						Registro con Google
					</p>

				</div>
			</a>

			<!--=====================================
			REGISTRO DIRECTO
			======================================-->

			<form method="post" onsubmit="return registroUsuario()">

			<hr>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-user"></i>

						</span>

						<input type="text" class="form-control input-lg text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-envelope"></i>

						</span>

						<input type="email" class="form-control input-lg" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-lock"></i>

						</span>

						<input type="password" class="form-control input-lg" id="regPassword" name="regPassword" placeholder="Contraseña" required>

					</div>

				</div>

				<!--=====================================
				https://www.iubenda.com/ CONDICIONES DE USO Y POLÍTICAS DE PRIVACIDAD
				======================================-->

				<div class="checkBox">

					<label>

						<input id="regPoliticas" type="checkbox">

							<small>

								Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad

								<br>

								<a href="//www.iubenda.com/privacy-policy/8146355" class="iubenda-white iubenda-embed" title="condiciones de uso y políticas de privacidad">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

							</small>

					</label>

				</div>

				<?php

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuario();

				?>

				<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">

			</form>

        </div>

        <div class="modal-footer">

			¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

        </div>

    </div>

</div>

<!--=====================================
VENTANA MODAL PARA EL INGRESO
======================================-->

<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">INGRESAR</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

			<!--=====================================
			INGRESO FACEBOOK
			======================================-->

			<div class="col-sm-6 col-xs-12 facebook">

				<p>
				  <i class="fa fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<!--=====================================
			INGRESO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">

				<div class="col-sm-6 col-xs-12 google">

					<p>
					  <i class="fa fa-google"></i>
						Ingreso con Google
					</p>

				</div>

			</a>

			<!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">

			<hr>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-envelope"></i>

						</span>

						<input type="email" class="form-control input-lg" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-lock"></i>

						</span>

						<input type="password" class="form-control input-lg" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>

					</div>

				</div>



				<?php

					$ingreso = new ControladorUsuarios();
					$ingreso -> ctrIngresoUsuario();

				?>

				<input type="submit" class="btn btn-default backColor btn-block btnIngreso" value="ENVIAR">

				<br>

				<center>

					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>

				</center>

			</form>

        </div>

        <div class="modal-footer">

			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>

    </div>

</div>


<!--=====================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
======================================-->

<div class="modal fade modalFormulario" id="modalPassword" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

			<!--=====================================
			OLVIDO CONTRASEÑA
			======================================-->

			<form method="post">

				<label class="text-muted">Escribe el correo electrónico con el que estás registrado y allí te enviaremos una nueva contraseña:</label>

				<div class="form-group">

					<div class="input-group">

						<span class="input-group-addon">

							<i class="glyphicon glyphicon-envelope"></i>

						</span>

						<input type="email" class="form-control input-lg" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<?php

					$password = new ControladorUsuarios();
					$password -> ctrOlvidoPassword();

				?>

				<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">

			</form>

        </div>

        <div class="modal-footer">

			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>

    </div>

</div>
