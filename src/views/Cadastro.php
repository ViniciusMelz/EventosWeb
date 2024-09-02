<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header('location: /EventosWeb/Menu');
} else {
    $erro = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $senhaDnv = $_POST['senhaDnv'];
        if ($senha === $senhaDnv) {

        } else {
            ?>
            <!-- <script async>
                $.ajax({
                    url: '.../src/views/Cadastro.php',
                    type: 'POST',
                    success: function (data) {
                        $("#inputNome").val(data.nome);
                        $("#inputEmail").val(data.email);
                        $("#inputLogin").val(data.login);
                        $("#inputSenha").val(data.senha);
                        $("#inputSenhaDnv").val(data.senhaDnv);
                    }
                });
            </script> -->
            <?php
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
                <input id="inputNome" type="text" name="nome" required>
                <input id="inputEmail" type="email" name="email" required>
                <input id="inputLogin" type="text" name="login" required>
                <input id="inputSenha" type="password" name="senha" required>
                <input id="inputSenhaDnv" type="password" name="senhaDnv" required>
                <input type="submit" value="Cadastro">
            </form>
            <p id="erro"><?php echo $erro ?></p>
            <a href="">Já possuo Conta? Login!</a>
        </div>
    </div>
</body>

</html>