<?php
class EventoController
{
    public static function listarEventosAPI(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require 'src/models/EventoModel.php';
            $dados = json_decode(file_get_contents("php://input"));
            $idUsuario = $dados->id;

            $model = new EventoModel();
            $buscarEventos = $model->buscarEventosUsuarioNaoIncritos($idUsuario);
            echo json_encode($buscarEventos);
        }
    }

    public static function buscarEventosUsuarioNaoIncritosAPI(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require 'src/models/EventoModel.php';

            $model = new EventoModel();
            $buscarEventos = $model->buscarEventos();
            echo json_encode($buscarEventos);
        }
    }

    public static function listarEventos(): array
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        $buscarEventos = $model->buscarEventos();
        return $buscarEventos;
    }

    public static function listarEventosPorNomeEvento(string $nomeEvento): array
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        $buscarEventos = $model->buscarEventosPorNomeEvento($nomeEvento);
        return $buscarEventos;
    }

    public static function listarEventosPorNomeUsuario(string $nomeUsuario): array
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        $buscarEventos = $model->buscarEventosPorNomeUsuario($nomeUsuario);
        return $buscarEventos;
    }

    public static function inserirEvento(string $tituloEvento, string $descricaoEvento, string $localEvento, string $dataEvento): bool
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        $inserirEvento = $model->inserirEvento($tituloEvento, $descricaoEvento, $localEvento, $dataEvento);
        return $inserirEvento;
    }

    public static function deletarEvento($idEvento): bool
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        $deletarEvento = $model->deletarEvento($idEvento);
        return $deletarEvento;
    }

    public static function buscarEventoEspecifico($idEvento): array
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        return $model->buscarEventoEspecifico($idEvento);
    }

    public static function atualizarEvento(int $idEvento, string $tituloEvento, string $descricaoEvento, string $localEvento, string $dataEvento): bool
    {
        require 'src/models/EventoModel.php';

        $model = new EventoModel();
        return $model->atualizarEvento($idEvento, $tituloEvento, $descricaoEvento, $localEvento, $dataEvento);
    }
}
