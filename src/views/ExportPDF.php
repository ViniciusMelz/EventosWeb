<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header('location: /eventosWeb/Login');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['idEvento'] = $_POST['idEvento'];
    } else if (isset($_SESSION['idEvento']) || $_SESSION['idEvento'] != null) {
        $idEvento = $_SESSION['idEvento'];
    
        require_once "src/controllers/ParticipacaoEventoController.php";
        $participacaoEventoController = new ParticipacaoEventoController();
        $participanteEvento = $participacaoEventoController->buscarUsuariosParticipacaoEventoEspecifico($idEvento);
    
        require_once "src/controllers/EventoController.php";
        $eventoController = new EventoController();
        $evento = $eventoController->buscarEventoEspecifico($idEvento);
        $tituloEvento = $evento[0]['titulo'];
        $descricaoEvento = $evento[0]['descricao'];
        $localEvento = $evento[0]['localEvento'];
        $dataEvento = $evento[0]['dataEvento'];
    
        if ($dataEvento == '0000-00-00') {
            $dataEvento = "";
        } else {
            $dataEvento = DateTime::createFromFormat('Y-m-d', $dataEvento)->format('d/m/Y');
        }
        require_once('src/fpdf/fpdf.php');
    
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 20);
        if(count($evento) != 0){
            $pdf->Cell(0, 10, $tituloEvento, 0, 1, 'L');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Descricao: ' . $descricaoEvento, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Local do Evento: ' . $localEvento, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Data do Evento: ' . $dataEvento, 0, 1, 'L');
        }else{
            $pdf->Cell(0, 10, 'Erro ao buscar dados do Evento!', 0, 1, 'L');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 12);
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
    
        if (count($participanteEvento) != 0) {
            $pdf->Cell(60, 10, 'Nome', 1, 0, 'C');
            $pdf->Cell(70, 10, 'Email', 1, 0, 'C');
            $pdf->Cell(60, 10, 'Telefone', 1, 1, 'C');
    
            $pdf->SetFont('Arial', '', 12);
    
            for ($i = 0; $i < count($participanteEvento); $i++) {
                $pdf->Cell(60, 10, $participanteEvento[$i]['nomeUsuario'], 1, 0, 'C');
                $pdf->Cell(70, 10, $participanteEvento[$i]['email'], 1, 0, 'C');
                $pdf->Cell(60, 10, $participanteEvento[$i]['telefone'], 1, 1, 'C');
            }
        }else{
            $pdf->Cell(0, 10, 'Nenhum Usuário Cadastrado no Evento!', 0, 1, 'L');
        }
    
        $pdf->Output('I', 'ParticipacoesEvento.pdf');
    
    } else {
        header('location: /eventosWeb/Eventos');
    }
}
