<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
    <p>Hola {{ $user->name }}</p>
    <p>Hemos recibido tu solicitud para modificar tu contraseña, puede completar el proceso presionando el siguiente enlace</p>
	<a href="{{ route('cliente.recuperar_contrasena_token', ['id' => $user->dep_cli_idn, 'token' =>$user->dep_token_web]) }}">
                RECUPERAR
    </a>
    <p>En caso de error, favor ignorar este correo.</p>

</body>
</html>