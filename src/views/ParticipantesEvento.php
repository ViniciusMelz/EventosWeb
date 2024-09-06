<?php
session_start();
$erro = "";
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['idEvento'] = $_POST['idEvento'];
    } else if (isset($_SESSION['idEvento']) || $_SESSION['idEvento'] != null) {
        $idEvento = $_SESSION['idEvento'];
    
        require_once "src/controllers/EventoController.php";
        $eventoController = new EventoController();
        $evento = $eventoController->buscarEventoEspecifico($idEvento);
        if (count($evento) == 1) {
            $idEvento = $evento[0]['id'];
            $tituloEvento = $evento[0]['titulo'];
            $descricaoEvento = $evento[0]['descricao'];
            $localEvento = $evento[0]['localEvento'];
            $dataEvento = $evento[0]['dataEvento'];
    
            if($dataEvento == '0000-00-00'){
                $dataEvento = "";
            }else{
                $dataEvento = DateTime::createFromFormat('Y-m-d', $dataEvento)->format('d/m/Y');
            }
        }else{
            echo "Erro ao buscar o Evento";
        }
    
        require_once "src/controllers/ParticipacaoEventoController.php";
        $participacaoEventoController = new ParticipacaoEventoController();
        $participanteEvento = $participacaoEventoController->buscarUsuariosParticipacaoEventoEspecifico($idEvento);
    } else {
        header('location: /eventosWeb/Eventos');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Participantes do Evento</title>
</head>

<body>
    <div class="container">
        <a href="Eventos" class="btn-back"><button>Voltar aos Eventos</button></a>
        <div class="event-details">
            <h1 class="event-title"><?php echo $tituloEvento ?></h1>
            <h2 class="event-description">Descrição: <?php echo $descricaoEvento ?></h2>
            <h2 class="event-location">Local do Evento: <?php echo $localEvento ?></h2>
            <h2 class="event-date">Data do Evento: <?php echo $dataEvento ?></h2>
        </div>
        <div class="participants-list">
            <table id="tabelaEventos">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($participanteEvento); $i++) {
                        echo '<tr>';
                        echo '<td>' . $participanteEvento[$i]['nomeUsuario'] . '</td>';
                        echo '<td>' . $participanteEvento[$i]['email'] . '</td>';
                        echo '<td>' . $participanteEvento[$i]['telefone'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
            </table>
        </div>
    </div>
</body>

</html>
<?php
}