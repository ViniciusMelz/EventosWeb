<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header('location: /EventosWeb/Menu');
} else {
    $erro = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        require_once "src/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->autenticarUsuario($login, $senha);
        if ($usuario != false) {
            $_SESSION["usuario"] = $usuario;
            header('location: /EventosWeb/Menu');
        } else {
            $erro = 'Login ou Senha Incorretos, Tente Novamente!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jubileu Eventos</title>
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<body>
    <div class="flex-container">
        <div id="containerLogin">
            <h1 id="tituloLogin">LOGIN</h1>
            <form action="" method="POST">
                <input type="text" name="login" required>
                <input type="password" name="senha" required>
                <input type="submit" value="Login">
            </form>
            <p id="erro"><?php echo $erro ?></p>
            <a href="Cadastro">Ainda não possui conta? Registrar!</a>
        </div>
    </div>
</body>

</html>