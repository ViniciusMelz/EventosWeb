<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    $erro = '';
    $tituloEvento = $descricaoEvento = $localEvento = $dataEvento = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tituloEvento = $_POST['tituloEvento'];
        $descricaoEvento = $_POST['descricaoEvento'];
        $localEvento = $_POST['localEvento'];
        $dataEvento = $_POST['dataEvento'];

        require_once "src/controllers/EventoController.php";
        $eventoController = new EventoController();
        $insercaoEvento = $eventoController->inserirEvento($tituloEvento, $descricaoEvento, $localEvento, $dataEvento);
        if($insercaoEvento) {
            ?>
            <div id="aviso">
                <?php echo 'Evento Cadastrado com Sucesso!' ?>
            </div>
            <script>
                const aviso = document.getElementById('aviso');
                aviso.style.display = 'block';
                setTimeout(function () {
                    aviso.style.display = 'none';
                }, 5000);
            </script>
            <?php
            $tituloEvento = $descricaoEvento = $localEvento = $dataEvento = "";
        } else {
            $erro = 'Erro ao cadastrar Evento, Tente novamente!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<body>
    <div class="flex-container">
        <div id="containerLogin">
            <h1 id="tituloLogin">CADASTRO DE EVENTO</h1>
            <form action="" method="POST">
                <label for="tituloEvento">Título do Evento</label>
                <input type="text" name="tituloEvento" value="<?php echo $tituloEvento ?>" required>
                <label for="descricaoEvento">Descrição do Evento</label>
                <input type="text" name="descricaoEvento" value="<?php echo $descricaoEvento ?>">
                <label for="localEvento">Local do Evento</label>
                <input type="text" name="localEvento" value="<?php echo $localEvento ?>">
                <label for="dataEvento">Data do Evento</label>
                <input type="date" name="dataEvento" value="<?php echo $dataEvento ?>" required>
                <input type="submit" value="Criar Evento">
            </form>
            <p id="erro"><?php echo $erro ?></p>
            <a href="Eventos"><button class="btn">Voltar aos Eventos</button></a>
        </div>
    </div>
</body>

</html>
<?php
}