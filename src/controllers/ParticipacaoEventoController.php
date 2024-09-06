<?php
class ParticipacaoEventoController
{
    public static function inserirParticipacaoEventoAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/ParticipacaoEventoModel.php';

            $idEvento = $dados->evento->id;
            $idUsuario = $dados->usuario->id;

            $model = new ParticipacaoEventoModel();

            $resultado = $model->inserirParticipacaoEvento($idUsuario, $idEvento);
            if ($resultado != false) {
                $resultadoBusca = $model->buscarParticipacaoEventoEspecifico($resultado);
                if (count($resultadoBusca) == 1) {
                    echo json_encode($resultadoBusca[0]);
                } else {
                    echo json_encode(array('status' => 'erro', 'mensagem' => 'Erro ao recuperar dados do usuário inserido.'));
                }
            }
        }
    }

    public static function buscarParticipacaoEventoAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'src/models/ParticipacaoEventoModel.php';

            $model = new ParticipacaoEventoModel();
            $buscarEventos = $model->buscarParticipacaoEvento();
            echo json_encode($buscarEventos);
        }
    }

    public static function deletarParticipacaoEventoAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/ParticipacaoEventoModel.php';

            $idParticipacaoEvento = $dados->id_participacao;

            $model = new ParticipacaoEventoModel();
            $confirmacaoDelete = $model->deletarParticipacaoEvento($idParticipacaoEvento);
            if ($confirmacaoDelete != false) {
                echo json_encode($dados);
            } else {
                echo json_encode($confirmacaoDelete);
            }
        }
    }

    public static function BuscarParticipacaoEventoUsuarioEspecificoAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/ParticipacaoEventoModel.php';

            $idUsuario = $dados->id;

            $model = new ParticipacaoEventoModel();
            $participacaoEventosUsuario = $model->buscarParticipacaoEventousuarioEspecifico($idUsuario);
            echo json_encode($participacaoEventosUsuario);
        }
    }

    public function buscarUsuariosParticipacaoEventoEspecifico(int $idEvento): array
    {
        require_once 'src/models/ParticipacaoEventoModel.php';

        $model = new ParticipacaoEventoModel();
        return $model->buscarUsuariosParticipacaoEventoEspecifico($idEvento);
    }
}