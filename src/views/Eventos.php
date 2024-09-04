<?php
session_start();
session_destroy();
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    require_once "src/controllers/EventoController.php";
    $eventoController = new EventoController();
    $eventos = $eventoController->listarEventos();
    print_r($eventos);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
</head>

<body>
    <table class="tabela" id="paddingBottonTabela">
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Local</th>
            <th>Data</th>
        </tr>
        <?php
        for ($i=0; $i < count($eventos); $i++) { 
            echo '<tr>';
            echo '<td>' . $usuario[$i]['titulo'] . '</td>';
            echo '<td>' . $usuario[$i]['descricao'] . '</td>';
            echo '<td>' . $usuario[$i]['localEvento'] . '</td>';
            echo '<td>' . $usuario[$i]['dataEvento'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>