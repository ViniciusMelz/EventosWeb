<?php
class ParticipacaoEventoDao
{
    private $conexao;

    public function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=eventos", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao = $pdo;
        } catch (PDOException $e) {
            echo 'Conexao falhou: ' . $e->getMessage();
        }
    }

    public function inserirParticipacaoEvento(int $idUsuario, int $idEvento): int|bool
    {
        $query = "INSERT INTO participacaoEventos (usuario_id, evento_id) VALUES ((?), (?));";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idEvento, PDO::PARAM_INT);

        if ($stmt->execute() == true) {
            return $this->conexao->lastInsertId();
        } else {
            return false;
        }
    }

    public function atualizarParticipacaoEvento(int $id, int $idUsuario, int $idEvento): bool
    {
        $query = "UPDATE participacaoEventos SET usuario_id = (?) , evento_id = (?) WHERE id_participacao = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(3, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletarParticipacaoEvento(int $id): bool
    {
        $query = "DELETE FROM participacaoEventos WHERE id_participacao = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function buscarParticipacaoEvento(): array
    {
        $query = "SELECT participacaoEventos.*, 
                  usuarios.id  AS 'id_usuario', usuarios.nomeUsuario, usuarios.email, usuarios.login, usuarios.senha, usuarios.ehAdmin, 
                  eventos.id AS 'id_evento', eventos.titulo, eventos.descricao, eventos.localEvento, eventos.dataEvento
                  FROM usuarios, participacaoEventos, eventos
                  WHERE usuarios.id = participacaoEventos.usuario_id
                  AND eventos.id = participacaoEventos.evento_id
                  ORDER BY 1";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        $participacoes = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $participacoes[] = [
                'id_participacao' => $result['id_participacao'],
                'usuario' => [
                    'id' => $result['id_usuario'],
                    'nomeUsuario' => $result['nomeUsuario'],
                    'email' => $result['email'],
                    'login' => $result['login'],
                    'senha' => $result['senha'],
                    'ehAdmin' => $result['ehAdmin']
                ],
                'evento' => [
                    'id' => $result['id_evento'],
                    'titulo' => $result['titulo'],
                    'descricao' => $result['descricao'],
                    'localEvento' => $result['localEvento'],
                    'dataEvento' => $result['dataEvento']
                ]
            ];
        }
        return $participacoes;
    }

    public function buscarParticipacaoEventoEspecifico(int $id): array
    {
        $query = "SELECT participacaoEventos.*, 
                  usuarios.id  AS 'id_usuario', usuarios.nomeUsuario, usuarios.email, usuarios.login, usuarios.senha, usuarios.ehAdmin, 
                  eventos.id AS 'id_evento', eventos.titulo, eventos.descricao, eventos.localEvento, eventos.dataEvento
                  FROM usuarios, participacaoEventos, eventos
                  WHERE usuarios.id = participacaoEventos.usuario_id
                  AND eventos.id = participacaoEventos.evento_id
                  AND participacaoEventos.id_participacao = (?)
                  ORDER BY 1";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $participacoes = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $participacoes[] = [
                'id_participacao' => $result['id_participacao'],
                'usuario' => [
                    'id' => $result['id_usuario'],
                    'nomeUsuario' => $result['nomeUsuario'],
                    'email' => $result['email'],
                    'login' => $result['login'],
                    'senha' => $result['senha'],
                    'ehAdmin' => $result['ehAdmin']
                ],
                'evento' => [
                    'id' => $result['id_evento'],
                    'titulo' => $result['titulo'],
                    'descricao' => $result['descricao'],
                    'localEvento' => $result['localEvento'],
                    'dataEvento' => $result['dataEvento']
                ]
            ];
        }
        return $participacoes;
    }
}
