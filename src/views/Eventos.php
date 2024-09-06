<?php
session_start();
$filtro = $tipoFiltro = '';
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    $_SESSION['idEvento'] = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once "src/controllers/EventoController.php";
        $eventoController = new EventoController();
        if (isset($_POST['tipoRequisicao'])) {
            $tipoRequisicao = $_POST['tipoRequisicao'];
            if ($tipoRequisicao === 'excluir') {
                $idEvento = $_POST['idEvento'];
                $delete = $eventoController->deletarEvento($idEvento);
            }
        }
        $tipoFiltro = $_POST['tipoFiltro'];
        $filtro = $_POST['filtro'];

        if ($tipoFiltro == '1') {
            $eventos = $eventoController->listarEventosPorNomeEvento($filtro);
            $_SESSION['eventos'] = $eventos;
        } else {
            $eventos = $eventoController->listarEventosPorNomeUsuario($filtro);
            $_SESSION['eventos'] = $eventos;
        }

    } else {
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
        <title>Jubileu Eventos</title>
    </head>

    <body>
        <div class="flex-wrapper">
            <div id="container">
                <div id="menuAcoes">
                    <div id="menuFuncionalidades">
                        <a href="criarEvento"><button class="btn">Criar Novo Evento</button></a>
                        <a href="exportXML"><button class="btn">Exportar Eventos em Lote</button></a>
                    </div>
                    <div id="divForm">
                        <form action="" method="POST" class="formFiltro">
                            <div id="divInputs">
                                <select name="tipoFiltro" id="comboTipoFiltro">
                                    <option value=1>Nome do Evento</option>
                                    <option value=2 <?php if ($tipoFiltro == 2)
                                        echo 'selected'; ?>>Nome do Usuário</option>
                                </select>
                                <input type="text" name="filtro" value="<?php echo $filtro ?>" required>
                            </div>
                            <div id="divBtnForm">
                                <input type="submit" value="Filtrar" class="btn" style="padding: 10px 15px">
                                <a href="Eventos"><button type='button' class="btn">Limpar Filtros</button></a>
                            </div>
                        </form>
                    </div>
                    <a href="logout"><button class="btn">Logout</button></a>
                </div>

                <div id="eventosContainer">
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
                            echo '<td>' . '<img src="src/assets/excluir.png" onclick="excluirEvento(this)" title="Excluir Evento" class="icon"/> 
                                       <img src="src/assets/editar.png" onclick="editarEvento(this)" title="Editar Evento" class="icon"/> 
                                       <img src="src/assets/participantes.png" onclick="participantesEvento(this)" title="Participantes do Evento" class="icon"/> 
                                       <img src="src/assets/exportarPDF.png" onclick="exportarParticipantesPDF(this)" title="Exportar PDF do Evento" class="icon"/>'
                                . '</td>';
                            echo '<td class="colunaId">' . $eventos[$i]['id'] . '</td>';
                            echo '<td>' . $eventos[$i]['titulo'] . '</td>';
                            echo '<td>' . $eventos[$i]['descricao'] . '</td>';
                            echo '<td>' . $eventos[$i]['localEvento'] . '</td>';
                            if ($eventos[$i]['dataEvento'] == '0000-00-00') {
                                $dataEvento = "";
                            } else {
                                $dataEvento = DateTime::createFromFormat('Y-m-d', $eventos[$i]['dataEvento'])->format('d/m/Y');
                            }
                            echo '<td>' . $dataEvento . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>

    </html>

    <?php
}
?>

<script>
    function excluirEvento(botao) {
        var id = $(botao).closest('tr').find('td.colunaId').text();
        console.log(id);
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                idEvento: id,
                tipoRequisicao: 'excluir'
            },
            success: function (response) {
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
                idEvento: id,
                tipoRequisicao: 'editar'
            },
            success: function (response) {
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
                idEvento: id,
                tipoRequisicao: 'listarParticipantes'
            },
            success: function (response) {
                window.location.href = 'participantesEvento';
            }
        });
    }

    function exportarParticipantesPDF(botao) {
        var id = $(botao).closest('tr').find('td.colunaId').text();
        console.log(id);
        $.ajax({
            url: 'exportPDF',
            type: 'POST',
            data: {
                idEvento: id,
                tipoRequisicao: 'exportarParticipantesPDF'
            },
            success: function (response) {
                window.location.href = 'exportPDF';
            }
        });
    }
</script>