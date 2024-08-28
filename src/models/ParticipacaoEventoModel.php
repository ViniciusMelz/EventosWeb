<?php

Class ParticipacaoEventoModel{
    public function buscarParticipacaoEvento() : array {
        require_once "src/DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->buscarParticipacaoEvento();
    }

    public function inserirParticipacaoEvento(int $idUsuario, int $idEvento) : int | bool {
        require_once "src/DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->inserirParticipacaoEvento($idUsuario, $idEvento);
    }

    public function deletarParticipacaoEvento(int $id) : bool{
        require_once "src/DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->deletarParticipacaoEvento($id);
    }

    public function atualizarParticipacaoEvento(int $id, int $idUsuario, int $idEvento) : bool {
        require_once "src/DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->atualizarParticipacaoEvento($id, $idUsuario, $idEvento);
    }
    public function buscarParticipacaoEventoEspecifico(int $id) : array {
        require_once "src/DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->buscarParticipacaoEventoEspecifico($id);
    }
}