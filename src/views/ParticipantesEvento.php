<?php
session_start();
$erro = "";
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
}
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
            $dataEvento = DateTime::createFromFormat('Y-m-d', $eventos[$i]['dataEvento'])->format('d/m/Y');
        }
    }else{
        echo "Erro ao buscar o Evento";
    }

    require_once "src/controllers/ParticipacaoEventoController.php";
    $participacaoEventoController = new ParticipacaoEventoController();
    $evento = $participacaoEventoController->buscarUsuariosParticipacaoEventoEspecifico($idEvento);
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
    <title>Eventos</title>
</head>

<body>
    <div>
        <h1><?php echo $tituloEvento ?></h1>
        <h2>Descrição: <?php echo $descricaoEvento ?></h2>
        <h2>Local do Evento: <?php echo $localEvento ?></h2>
        <h2>Data do Evento: <?php echo $dataEvento ?></h2>
    </div>
    <div>
        <table id="tabelaEventos">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Local</th>
                <th>Data</th>
            </tr>
            <?php
            for ($i = 0; $i < count($eventos); $i++) {
                echo '<tr>';
                echo '<td>' . '<img src="src/assets/excluir.png" onclick="excluirEvento(this)" title="Excluir Evento"/> 
                               <img src="src/assets/editar.png" onclick="editarEvento(this)" title="Editar Evento"/> 
                               <img src="src/assets/participantes.png" onclick="participantesEvento(this)" title="Participantes do Evento"/>
                               <img src="src/assets/exportarPDF.png" onclick="excluirEvento(this)" title="Exportar PDF do "/>'
                 . '</td>';
                echo '<td class="colunaId">' . $eventos[$i]['id'] . '</td>';
                echo '<td>' . $eventos[$i]['titulo'] . '</td>';
                echo '<td>' . $eventos[$i]['descricao'] . '</td>';
                echo '<td>' . $eventos[$i]['localEvento'] . '</td>';
                if($eventos[$i]['dataEvento'] == '0000-00-00'){
                    $dataEvento = "";
                }else{
                    $dataEvento = DateTime::createFromFormat('Y-m-d', $eventos[$i]['dataEvento'])->format('d/m/Y');
                }
                echo '<td>' . $dataEvento . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>
