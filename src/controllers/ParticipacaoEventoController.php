<?php
class ParticipacaoEventoController
{
    public static function inserirParticipacaoEventoAPI(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/ParticipacaoEventoModel.php';

            $idEvento = $dados->evento->id;
            $idUsuario = $dados->usuario->id;

            $model = new ParticipacaoEventoModel();

            $resultado = $model->inserirParticipacaoEvento($idUsuario, $idEvento);
            if($resultado != false){
                $resultadoBusca = $model->buscarParticipacaoEventoEspecifico($resultado);
                if(count($resultadoBusca) == 1){
                    echo json_encode($resultadoBusca);
                }else{
                    echo json_encode(array('status' => 'erro', 'mensagem' => 'Erro ao recuperar dados do usuário inserido.'));
                }
            }
        }
    }

    public static function buscarParticipacaoEventoAPI(){
        if($_SERVER['REQUEST_METHOD']=='POST') {
            require_once 'src/models/ParticipacaoEventoModel.php';

            $model = new ParticipacaoEventoModel();
            $buscarEventos = $model->buscarParticipacaoEvento();
            echo json_encode($buscarEventos);
        }
    }
}