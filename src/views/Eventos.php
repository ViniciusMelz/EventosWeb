<?php
session_start();
$filtro = $tipoFiltro = '';
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
}
$_SESSION['idEvento'] = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "src/controllers/EventoController.php";
    $eventoController = new EventoController();
    if(isset($_POST['tipoRequisicao'])){
        $tipoRequisicao = $_POST['tipoRequisicao'];
        if($tipoRequisicao === 'excluir'){
            $idEvento = $_POST['idEvento'];
            $delete = $eventoController->deletarEvento($idEvento);
        }
    }else{

    }
    $tipoFiltro = $_POST['tipoFiltro'];
    $filtro = $_POST['filtro'];

    if($tipoFiltro == '1'){
        $eventos = $eventoController->listarEventosPorNomeEvento($filtro);
        $_SESSION['eventos'] = $eventos;
    }else{
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <a href="logout"><button>Logout</button></a>
    </div>
    <div>
        <table id="tabelaEventos">
            <tr>
                <th></th>
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
                               <img src="src/assets/exportarPDF.png" onclick="excluirEvento(this)" title="Exportar PDF do Evento"/>'
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

    <script>
        function excluirEvento(botao) {
            var id = $(botao).closest('tr').find('td.colunaId').text();
            console.log(id);
            $.ajax({
                url: '',
                type: 'POST',
                data: { 
                    idEvento: id ,
                    tipoRequisicao: 'excluir'
                },
                success: function(response) {
                    window.location.reload(true);
                }
            });
        }

        function editarEvento(botao) {
            var id = $(botao).closest('tr').find('td.colunaId').text();
            console.log(id);
            $.ajax({
                url: 'editarEvento',
                type: 'POST',
                data: { 
                    idEvento: id ,
                    tipoRequisicao: 'editar'
                },
                success: function(response) {
                    window.location.href = 'editarEvento';
                }
            });
        }

        function participantesEvento(botao) {
            var id = $(botao).closest('tr').find('td.colunaId').text();
            console.log(id);
            $.ajax({
                url: 'participantesEvento',
                type: 'POST',
                data: { 
                    idEvento: id ,
                    tipoRequisicao: 'listarParticipantes'
                },
                success: function(response) {
                    window.location.href = 'participantesEvento';
                }
            });
        }
    </script>