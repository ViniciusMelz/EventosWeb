<?php
class UsuarioController
{
    public static function autenticarUsuarioAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/UsuarioModel.php';

            $login = $dados->login;
            $senha = $dados->senha;

            $model = new UsuarioModel();

            if (!empty($login) && !empty($senha)) {
                $resultado = $model->autenticarUsuario($login, $senha);
                if (count($resultado) == 1) {
                    echo json_encode($resultado[0]);
                } else {
                    echo json_encode(array("erro" => "Login e senha invalidos."));
                }
            }
        } else {
            echo "ERRO: Método inválido!";
        }
    }

    public static function inserirUsuarioAPI()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/UsuarioModel.php';

            $nome = $dados->nomeUsuario;
            $email = $dados->email;
            $login = $dados->login;
            $senha = $dados->senha;
            $ehAdmin = $dados->ehAdmin;
            $telefone = '';
            if(isset($dados->telefone)){
                $telefone = $dados->telefone;
            }

            $model = new UsuarioModel();

            $resultado = $model->inserirUsuario($nome, $email, $login, $senha, $ehAdmin, $telefone);
            if ($resultado != false) {
                $resultadoBusca = $model->buscarUsuarioEspecifico($resultado);
                if (count($resultadoBusca) == 1) {
                    echo json_encode($resultadoBusca[0]);
                } else {
                    echo json_encode(array('status' => 'erro', 'mensagem' => 'Erro ao recuperar dados do usuário inserido.'));
                }
            } else {
                echo json_encode(array('status' => 'erro', 'mensagem' => 'ERRO: Login ou Email já utilizado'));
            }
        }
    }

    public function autenticarUsuario(string $login, string $senha): array | bool
    {
        require_once 'src/models/UsuarioModel.php';

        $model = new UsuarioModel();

        if (!empty($login) && !empty($senha)) {
            $resultado = $model->autenticarUsuario($login, $senha);
            if (count($resultado) == 1) {
                return $resultado;
            } else {
                return false;
            }
        }
        return false;
    }

    public function inserirUsuario(string $nome, string $email, string $login, string $senha, string $telefone = ''): array | bool | string
    {
        require_once 'src/models/UsuarioModel.php';

        $model = new UsuarioModel();
        $ehAdmin = 1;
        $resultado = $model->inserirUsuario($nome, $email, $login, $senha, $ehAdmin, $telefone);
        if ($resultado != false) {
            $resultadoBusca = $model->buscarUsuarioEspecifico($resultado);
            if (count($resultadoBusca) == 1) {
                return $resultadoBusca;
            } else {
                return 'Erro ao recuperar dados do usuário inserido.';
            }
        } else {
            return 'ERRO: Login ou Email já utilizado';
        }
    }
}
