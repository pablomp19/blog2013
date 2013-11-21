<link rel="stylesheet" type="text/css" href="css/registro.css" />
<?php

// Información sobre cómo validar un formulario en PHP en cuanto a temas de seguridad.
// MUY RECOMENDABLE: http://www.w3schools.com/php/php_form_validation.asp
// Expresiones regulares: http://webcheatsheet.com/php/regular_expressions.php
// Si quieres usar code-folding escribe [fcom] y pulsa [TAB]
// <editor-fold defaultstate="collapsed" desc="Función depurar">
function depurar($data)
{
	$data = trim($data); // Elimina espacios al principio y final.
	$data = stripslashes($data); // Elimina las barras de escape
	$data = htmlspecialchars($data); // Convierte los caracteres HTML a su literal correspondiente.
	return $data;
}

// </editor-fold>
// VALIDACIÓN DE LOS DATOS DEL FORMULARIO AQUI.
// Para comprobar si estamos recibiendo datos del formulario se puede utilizar:
// if (!empty($_POST)) // estamos recibiendo datos por POST
// empty() es esencialmente el equivalente conciso de !isset($var) || $var == false.
// Otra forma puede ser:
if ( $_SERVER['REQUEST_METHOD'] == "POST" ) // estamos recibiendo datos por POST
{ // Aqui dentro validaremos todo y grabaremos en la base de datos.
	$errores = array();

	// Primero depuramos los campos, luego los validaremos.
	//$_POST['nickname']=depurar($_POST['nickname']);
	foreach ($_POST as $clave => $valor)
	{
		$_POST[$clave] = depurar($valor);
	}

	// Como todos los campos son de texto podemos comprobar rápidamente que todos los campos tengan datos.
	// Damos por supuesto que todos los campos en el formulario son obligatorios.
	foreach ($_POST as $clave => $valor)
	{
		if ( empty($valor))
			$errores[] = "The field $clave is mandatory.";
	}

	

        if(!preg_match('/^[a-zA-Z0-9_\-]{4,20}$/', $_POST['nickname'])){
            $errores[]='El nickname debe tener mínimo de 4 y máx de 20 caracteres';
        }

        
        //El nombre=nickname y máximo de 20 caracteres.
        
        if(!preg_match('/^[a-zA-Z0-9_\-]{0,20}$/', $_POST['name'])){
            $errores[]='El name debe  máx de 20 caracteres';
        }

        
        //Los apellidos =que nickname y máximo 100 caracteres.
        
        if(!preg_match('/^[a-zA-Z0-9_\-]{0,100}$/', $_POST['surname'])){
            $errores[]='El surname debe tener máx de 100 caracteres';
        }
        
        //Validar email
        
        if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $_POST['email'])){
            $errores[]='Escribe un email correcto';
        }

        
        //Validar fecha(formato dd/mm/aaaa)
        
        if(!preg_match('/^[0-9]{2}[\/]{1}[0-9]{2}[\/]{1}[0-9]{4}$/', $_POST['birthday'])){
            $errores[]='Fecha incorrecta';
        }
        
        //La contraseña debe tener de 6 a 15 caracteres, 1 minúscula, 1 mayúscula, 1 número.
        
        if(!preg_match('/(?=.*[a-z]).*(?=.*[A-Z]).*(?=.*[0-9]).*(?=.*[\W]).*/')){
            
        }

        
        // <editor-fold defaultstate="collapsed" desc="DIV Errores.">
	// Mostramos a continuación el contenedor errores y cubrimos su contenido con el array de errores.
	echo '<div class="errores"><ul>';
	for ($i = 0; $i < count($errores); $i++)
		echo "<li>{$errores[$i]}</li>";
	echo '</ul></div>';
	// </editor-fold>
	// <editor-fold defaultstate="collapsed" desc="Ejemplo impresión del contenido de $_POST">
	/* Forma de imprimir el contenido de un $_POST formateado:
	  echo "<pre>";
	  print_r($_POST);
	  echo "</pre>";
	 */
	// </editor-fold>
}
?>
<form class="formulario" action="" method="post" autocomplete="off">
	<ul>
		<li>
			<h2>Registration Form</h2>
		</li>
		<li>
			<label for="nickname">Nickname:</label>
			<input type="text" name="nickname" id="nickname" placeholder="nickname" required autofocus size="10" maxlength="20" value="<?php if(!empty($_POST['nickname'])) echo $_POST['nickname']; ?>"/>
		</li>
		<li>
			<label for="name">Name:</label>
			<input type="text" name="name" id="name" placeholder="Your name" size="10" maxlength="20" value="<?php if(!empty($_POST['name'])) echo $_POST['name']; ?>"/>
		</li>
		<li>
			<label for="surname">Surname:</label>
			<input type="text" name="surname" id="surname" placeholder="Your surname here" size="20" maxlength="100" value="<?php if(!empty($_POST['surname'])) echo $_POST['surname']; ?>"/>
		</li>
		<li>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" required size="10" maxlength="130" value="<?php if(!empty($_POST['password'])) echo $_POST['password']; ?>"/>
		</li>
		<li>
			<label for="email">E-mail address:</label>
			<input type="email" name="email" id="email" placeholder="test@info.local" size="20" maxlength="50" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>"/>
		</li>
		<li>
			<label for="birthday">Birthday:</label>
			<input type="text" name="birthday" id="birthday" />
		</li>
		<!--- ESTA SECCIÓN SE UTILIZARÁ PARA VALIDAR EN CLASE DE DWEC --->





		<!--- ESTA SECCIÓN SE UTILIZARÁ PARA VALIDAR EN CLASE DE DWEC --->
		<li>
			<input type="reset" class="controles" value="Reset" />
			<input type="submit" class="controles" value="Sign Up" />
		</li>
	</ul>
</form>