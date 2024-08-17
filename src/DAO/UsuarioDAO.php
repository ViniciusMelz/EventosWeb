<?php
class UsuarioDao{
    private $conexao;

    public function __construct() {
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=eventos", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao = $pdo;
        }catch(PDOException $e){
            echo 'Conexao falhou: '.$e->getMessage();
        }
    }

    public function inserirUsuario(string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin): bool{
        $query = "INSERT INTO usuarios (nomeUsuario, email, login, senha, ehAdmin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $login, PDO::PARAM_STR);
        $stmt->bindParam(4, $senha, PDO::PARAM_STR);
        $stmt->bindParam(5, $ehAdmin, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizarUsuario(int $id, string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin): bool{
        $query = "UPDATE usuarios SET nomeUsuario = (?), email = (?), login = (?), senha = (?), ehAdmin = (?) WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $login, PDO::PARAM_STR);
        $stmt->bindParam(4, $senha, PDO::PARAM_STR);
        $stmt->bindParam(5, $ehAdmin, PDO::PARAM_INT);
        $stmt->bindParam(6, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletarUsuario(int $id): bool{
        $query = "DELETE FROM usuarios WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function buscarUsuarios(): array{
        $query = "SELECT * FROM USUARIOS";
        $stmt = $this->conexao->prepare($query);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}