<?php

Class EventoModel{
    public function buscarEventos() : array {
        require_once "src/DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->buscarEventos();
    }

    public function buscarEventosUsuarioNaoIncritos($idUsuario) : array {
        require_once "src/DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->buscarEventosUsuarioNaoIncritos($idUsuario);
    }

    public function inserirEvento(string $tituloEvento, string $descricao, string $localEvento, string $data) : bool {
        require_once "src/DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->inserirEvento($tituloEvento, $descricao, $localEvento, $data);
    }

    public function deletarEvento(int $id) : bool{
        require_once "src/DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->deletarEvento($id);
    }

    public function atualizarEvento(int $id, string $tituloEvento, string $descricao, string $localEvento, string $data) : bool {
        require_once "src/DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->atualizarEvento($id, $tituloEvento, $descricao, $localEvento, $data);
    }
}