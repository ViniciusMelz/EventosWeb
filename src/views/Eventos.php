<?php
session_start();
$filtro = $tipoFiltro = '';
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipoFiltro = $_POST['tipoFiltro'];
    $filtro = $_POST['filtro'];

    require_once "src/controllers/EventoController.php";
    if($tipoFiltro == '1'){
        $eventoController = new EventoController();
        $eventos = $eventoController->listarEventosPorNomeEvento($filtro);
        $_SESSION['eventos'] = $eventos;
    }else{
        $eventoController = new EventoController();
        $eventos = $eventoController->listarEventosPorNomeUsuario($filtro);
        $_SESSION['eventos'] = $eventos;
    }
    
}else{
    require_once "src/controllers/EventoController.php";
    $eventoController = new EventoController();
    $eventos = $eventoController->listarEventos();
    $_SESSION['eventos'] = $eventos;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Eventos</title>
</head>

<body>
    <div>
        <a href="criarEvento"><button>Criar Novo Evento</button></a>
        <a href="exportXML"><button>Exportar Eventos em Lote</button></a>

        <label for="tipoFiltro">Filtrar Por:</label>
        <form action="" method="POST">
            <select name="tipoFiltro" id="comboTipoFiltro">
                <option value=1>Nome do Evento</option>
                <option value=2 <?php if ($tipoFiltro == 2) echo 'selected'; ?> >Nome do Usuário</option>
            </select>
            <input type="text" name="filtro" value="<?php echo $filtro ?>"required>
            <input type="submit" value="Filtrar">
        </form>
        <a href="Eventos"><button>Limpar Filtros</button></a>
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
                echo '<td>' . $eventos[$i]['id'] . '</td>';
                echo '<td>' . $eventos[$i]['titulo'] . '</td>';
                echo '<td>' . $eventos[$i]['descricao'] . '</td>';
                echo '<td>' . $eventos[$i]['localEvento'] . '</td>';
                echo '<td>' . DateTime::createFromFormat('Y-m-d', $eventos[$i]['dataEvento'])->format('d/m/Y') . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>