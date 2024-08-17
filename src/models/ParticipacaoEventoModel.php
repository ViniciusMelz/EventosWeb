<?php

Class ParticipacaoEventoModel{
    public function buscarParticipacaoEvento() : array {
        require "../DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->buscarParticipacaoEvento();
    }

    public function inserirParticipacaoEvento(int $idUsuario, int $idEvento) : bool {
        require "../DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->inserirParticipacaoEvento($idUsuario, $idEvento);
    }

    public function deletarParticipacaoEvento(int $id) : bool{
        require "../DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->deletarParticipacaoEvento($id);
    }

    public function atualizarParticipacaoEvento(int $id, int $idUsuario, int $idEvento) : bool {
        require "../DAO/ParticipacaoEventoDAO.php";

        $dao = new ParticipacaoEventoDao();

        return $dao->atualizarParticipacaoEvento($id, $idUsuario, $idEvento);
    }
}