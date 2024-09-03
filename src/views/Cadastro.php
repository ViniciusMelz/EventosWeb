<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Menu');
} else {
    $erro = '';
    $nome = $email = $login = $senha = $senhaDnv = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $senhaDnv = $_POST['senhaDnv'];
        if ($senha === $senhaDnv) {
            require_once "src/controllers/UsuarioController.php";
            $usuarioController = new UsuarioController();
            $usuario = $usuarioController->inserirUsuario($nome, $email, $login, $senha);
            if(!is_string($usuario)){
                ?>
                <div id="aviso"><?php echo 'Usuário Cadastrado com Sucesso!' ?></div>
                <script>
                    const aviso = document.getElementById('aviso');
                    aviso.style.display = 'block';
                    setTimeout(function() {
                        aviso.style.display = 'none';
                    }, 3000);
                </script>
                <?php
                sleep(3);
                header('location: /eventosWeb/Login');
            }
        } else {
            $erro = 'As senhas devem ser Iguais!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Jubileu Eventos</title>
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<body>
    <div class="flex-container">
        <div id="containerLogin">
            <h1 id="tituloLogin">CADASTRO</h1>
            <form action="" method="POST">
                <input id="inputNome" type="text" name="nome" value="<?php echo $nome ?>" required>
                <input id="inputEmail" type="email" name="email" value="<?php echo $email ?>" required>
                <input id="inputLogin" type="text" name="login" value="<?php echo $login ?>" required>
                <input id="inputSenha" type="password" name="senha" value="<?php echo $senha ?>" required>
                <input id="inputSenhaDnv" type="password" name="senhaDnv" value="<?php echo $senhaDnv ?>" required>
                <input type="submit" value="Cadastro">
            </form>
            <p id="erro"><?php echo $erro ?></p>
            <a href="Login">Já possuo Conta? Login!</a>
        </div>
    </div>
</body>

</html>