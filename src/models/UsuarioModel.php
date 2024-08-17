<?php

Class UsuarioModel{
    public function buscarUsuarios() : array {
        require "../DAO/UsuarioDAO.php";

        $dao = new UsuarioDao();

        return $dao->buscarUsuarios();
    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin) : bool {
        require "../DAO/UsuarioDAO.php";

        $dao = new UsuarioDao();

        return $dao->inserirUsuario($nomeUsuario, $email, $login, $senha, $ehAdmin);
    }

    public function deletarUsuario(int $id) : bool{
        require "../DAO/UsuarioDAO.php";

        $dao = new UsuarioDao();

        return $dao->deletarUsuario($id);
    }

    public function atualizarUsuario(int $id, string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin) : bool {
        require "../DAO/UsuarioDAO.php";

        $dao = new UsuarioDao();

        return $dao->atualizarUsuario($id, $nomeUsuario, $email, $login, $senha, $ehAdmin);
    }
}