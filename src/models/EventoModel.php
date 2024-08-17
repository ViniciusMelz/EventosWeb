<?php

Class EventoModel{
    public function buscarEvento() : array {
        require "../DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->buscarEvento();
    }

    public function inserirEvento(string $tituloEvento, string $descricao, string $localEvento, string $data) : bool {
        require "../DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->inserirEvento($tituloEvento, $descricao, $localEvento, $data);
    }

    public function deletarEvento(int $id) : bool{
        require "../DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->deletarEvento($id);
    }

    public function atualizarEvento(int $id, string $tituloEvento, string $descricao, string $localEvento, string $data) : bool {
        require "../DAO/EventoDAO.php";

        $dao = new EventoDao();

        return $dao->atualizarEvento($id, $tituloEvento, $descricao, $localEvento, $data);
    }
}