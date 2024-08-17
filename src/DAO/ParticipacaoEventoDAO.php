<?php
class ParticipacaoEventoDao{
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

    public function inserirParticipacaoEvento(int $idUsuario, int $idEvento): bool{
        $query = "INSERT INTO participacaoEventos (usuario_id, evento_id) VALUES ((?), (?));";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idEvento, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizarParticipacaoEvento(int $id, int $idUsuario, int $idEvento): bool{
        $query = "UPDATE participacaoEventos SET usuario_id = (?) , evento_id = (?) WHERE id_participacao = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(3, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletarParticipacaoEvento(int $id): bool{
        $query = "DELETE FROM participacaoEventos WHERE id_participacao = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function buscarParticipacaoEvento(): array{
        $query = "SELECT participacaoEventos.*, usuarios.*, eventos.* 
                  FROM usuarios, participacaoEventos, eventos
                  WHERE usuarios.id = participacaoEventos.usuario_id
                  AND eventos.id = participacaoEventos.evento_id
                  ORDER BY 1";
        $stmt = $this->conexao->prepare($query);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}
