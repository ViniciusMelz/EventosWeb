<?php
class UsuarioDao
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

    public function inserirUsuario(string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin): int|bool
    {
        $senhaIncriptografada = $this->CriptografarSenha($senha);
        $query = "INSERT INTO usuarios (nomeUsuario, email, login, senha, ehAdmin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $login, PDO::PARAM_STR);
        $stmt->bindParam(4, $senhaIncriptografada, PDO::PARAM_STR);
        $stmt->bindParam(5, $ehAdmin, PDO::PARAM_INT);

        try{
            if ($stmt->execute() == true) {
                return $this->conexao->lastInsertId();
            } else {
                return false;
            }
        }catch(Exception){
            return false;
        }
        
    }

    public function atualizarUsuario(int $id, string $nomeUsuario, string $email, string $login, string $senha, int $ehAdmin): bool
    {
        $senhaIncriptografada = $this->CriptografarSenha($senha);
        $query = "UPDATE usuarios SET nomeUsuario = (?), email = (?), login = (?), senha = (?), ehAdmin = (?) WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $login, PDO::PARAM_STR);
        $stmt->bindParam(4, $senhaIncriptografada, PDO::PARAM_STR);
        $stmt->bindParam(5, $ehAdmin, PDO::PARAM_INT);
        $stmt->bindParam(6, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletarUsuario(int $id): bool
    {
        $query = "DELETE FROM usuarios WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function buscarUsuarios(): array
    {
        $query = "SELECT * FROM USUARIOS";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        $participacoes = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $participacoes[] = [
                'id' => $result['id'],
                'nomeUsuario' => $result['nomeUsuario'],
                'email' => $result['email'],
                'login' => $result['login'],
                'senha' => $this->DesincriptografarSenha($result['senha']),
                'ehAdmin' => $result['ehAdmin']
            ];
        }
        return $participacoes;
    }

    public function autenticarUsuario(string $login, string $senha): array
    {
        $query = "SELECT * FROM usuarios WHERE login = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->execute();
        $participacoes = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->DesincriptografarSenha($result['senha']) === $senha) {
                $participacoes[] = [
                    'id' => $result['id'],
                    'nomeUsuario' => $result['nomeUsuario'],
                    'email' => $result['email'],
                    'login' => $result['login'],
                    'senha' => $this->DesincriptografarSenha($result['senha']),
                    'ehAdmin' => $result['ehAdmin']
                ];
            }
        }
        return $participacoes;
    }

    public function buscarUsuarioEspecifico(int $id): array
    {
        $query = "SELECT * FROM usuarios WHERE id = (?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $participacoes = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $participacoes[] = [
                'id' => $result['id'],
                'nomeUsuario' => $result['nomeUsuario'],
                'email' => $result['email'],
                'login' => $result['login'],
                'senha' => $this->DesincriptografarSenha($result['senha']),
                'ehAdmin' => $result['ehAdmin']
            ];
        }
        return $participacoes;
    }

    private function CriptografarSenha($senha)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $senhaIncriptografada = openssl_encrypt($senha, 'aes-256-cbc', 'criptografia', 0, $iv);
        return base64_encode($senhaIncriptografada . '::' . $iv);
    }

    private function DesincriptografarSenha($senha)
    {
        list($senhaIncriptografada, $iv) = explode('::', base64_decode($senha), 2);
        return openssl_decrypt($senhaIncriptografada, 'aes-256-cbc', 'criptografia', 0, $iv);
    }
}