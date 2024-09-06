<?php
session_start();
$erro = $desabilitarBotao = "";
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['tituloEvento'])) {
            $idEvento = $_POST['idEvento'];
            $tituloEvento = $_POST['tituloEvento'];
            $descricaoEvento = $_POST['descricaoEvento'];
            $localEvento = $_POST['localEvento'];
            $dataEvento = $_POST['dataEvento'];
    
            require_once "src/controllers/EventoController.php";
            $eventoController = new EventoController();
            $attEvento = $eventoController->atualizarEvento($idEvento, $tituloEvento, $descricaoEvento, $localEvento, $dataEvento);
    
            if ($attEvento) {
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
            } else {
                $erro = 'Erro ao editar Evento, Tente novamente!';
            }
    
        } else {
            $_SESSION['idEvento'] = $_POST['idEvento'];
        }
    } else if (isset($_SESSION['idEvento']) || $_SESSION['idEvento'] != null) {
        $idEvento = $_SESSION['idEvento'];
        $tituloEvento = $descricaoEvento = $localEvento = $dataEvento = "";
    
        require_once "src/controllers/EventoController.php";
        $eventoController = new EventoController();
        $evento = $eventoController->buscarEventoEspecifico($idEvento);
        if (count($evento) == 1) {
            $idEvento = $evento[0]['id'];
            $tituloEvento = $evento[0]['titulo'];
            $descricaoEvento = $evento[0]['descricao'];
            $localEvento = $evento[0]['localEvento'];
            $dataEvento = $evento[0]['dataEvento'];
        }
        else {
            $erro = 'Erro ao buscar dados do evento, tente novamente!';
            $idEvento = "";
            $desabilitarBotao = 'disabled';
        }
    } else {
        header('location: /eventosWeb/Eventos');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" type="text/css" href="src/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<body>
    <div class="flex-container">
        <div id="containerLogin">
            <h1 id="tituloLogin">EDIÇÃO DE EVENTO</h1>
            <form action="" method="POST">
                <label for="idEvento">ID do Evento</label>
                <input type="text" name="idEvento" value="<?php echo $idEvento ?>" readonly>
                <label for="tituloEvento">Título do Evento</label>
                <input type="text" name="tituloEvento" value="<?php echo $tituloEvento ?>" required>
                <label for="descricaoEvento">Descrição do Evento</label>
                <input type="text" name="descricaoEvento" value="<?php echo $descricaoEvento ?>">
                <label for="localEvento">Local do Evento</label>
                <input type="text" name="localEvento" value="<?php echo $localEvento ?>">
                <label for="dataEvento">Data do Evento</label>
                <input type="date" name="dataEvento" value="<?php echo $dataEvento ?>" required>
                <input id="botaoConfirmarEdicao" type="submit" value="Editar Evento" <?php echo $desabilitarBotao ?>>
            </form>
            <p id="erro"><?php echo $erro ?></p>
            <a href="Eventos"><button class="btn">Voltar aos Eventos</button></a>
        </div>
    </div>
</body>

</html>
<?php
}