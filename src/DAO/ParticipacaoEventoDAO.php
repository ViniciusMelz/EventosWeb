<?php
class ParticipacaoEventoDao
{
    private $conexao;

    public function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=eventos;port=3306", "root", "");
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
                    'senha' => $this->DesincriptografarSenha($result['senha']),
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
                    'senha' => $this->DesincriptografarSenha($result['senha']),
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

    public function buscarParticipacaoEventoUsuarioEspecifico(int $id): array
    {
        $query = "SELECT participacaoEventos.*, 
                  usuarios.id  AS 'id_usuario', usuarios.nomeUsuario, usuarios.email, usuarios.login, usuarios.senha, usuarios.ehAdmin, 
                  eventos.id AS 'id_evento', eventos.titulo, eventos.descricao, eventos.localEvento, eventos.dataEvento
                  FROM usuarios, participacaoEventos, eventos
                  WHERE usuarios.id = participacaoEventos.usuario_id
                  AND eventos.id = participacaoEventos.evento_id
                  AND usuarios.id = (?)
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
                    'senha' => $this->DesincriptografarSenha($result['senha']),
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

    private function CriptografarSenha($senha):string {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $senhaIncriptografada = openssl_encrypt($senha, 'aes-256-cbc', 'criptografia', 0, $iv);
        return base64_encode($senhaIncriptografada . '::' . $iv);
    }    

    private function DesincriptografarSenha($senha) {
        list($senhaIncriptografada, $iv) = explode('::', base64_decode($senha), 2);
        return openssl_decrypt($senhaIncriptografada, 'aes-256-cbc', 'criptografia', 0, $iv);
    }
}
