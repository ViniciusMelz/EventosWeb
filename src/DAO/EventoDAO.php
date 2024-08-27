<?php
class EventoDao{
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

    public function inserirEvento(string $tituloEvento, string $descricao, string $localEvento, string $data): bool{
        $query = "INSERT INTO eventos (titulo, descricao, localEvento, dataEvento) VALUES ((?), (?), (?), (?))";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $tituloEvento, PDO::PARAM_STR);
        $stmt->bindParam(2, $descricao, PDO::PARAM_STR);
        $stmt->bindParam(3, $localEvento, PDO::PARAM_STR);
        $stmt->bindParam(4, $data, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function atualizarEvento(int $id, string $tituloEvento, string $descricao, string $localEvento, string $data): bool{
        $query = "UPDATE eventos set titulo = (?), descricao = (?), localEvento = (?), dataEvento = (?) where id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $tituloEvento, PDO::PARAM_STR);
        $stmt->bindParam(2, $descricao, PDO::PARAM_STR);
        $stmt->bindParam(3, $localEvento, PDO::PARAM_STR);
        $stmt->bindParam(4, $data, PDO::PARAM_STR);
        $stmt->bindParam(5, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletarEvento(int $id): bool{
        $query = "DELETE FROM eventos WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function buscarEventos(): array{
        $query = "SELECT * FROM eventos";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}