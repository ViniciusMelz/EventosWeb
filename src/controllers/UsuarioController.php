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
            
            if(!empty($login) && !empty($senha)){
                $resultado = $model->autenticarUsuario($login, $senha);
                if(count($resultado) == 1){
                    echo json_encode($resultado);
                }else{
                    echo json_encode(array("erro" => "Login e senha invalidos."));
                }
            }
        }else{
            echo "ERRO: Método inválido!";
        }
    }

    public static function inserirUsuarioAPI(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = json_decode(file_get_contents("php://input"));
            require_once 'src/models/UsuarioModel.php';

            $nome = $dados->nomeUsuario;
            $email = $dados->email;
            $login = $dados->login;
            $senha = $dados->senha;
            $ehAdmin = $dados->ehAdmin;

            $model = new UsuarioModel();

            $resultado = $model->inserirUsuario($nome, $email, $login, $senha, $ehAdmin);
            if($resultado != false){
                $resultadoBusca = $model->buscarUsuarioEspecifico($resultado);
                if(count($resultadoBusca) == 1){
                    echo json_encode($resultadoBusca);
                }else{
                    echo json_encode(array('status' => 'erro', 'mensagem' => 'Erro ao recuperar dados do usuário inserido.'));
                }
            }else{
                echo json_encode(array('status' => 'erro', 'mensagem' => 'ERRO: Login ou Email já utilizado'));
            }
        }
    }
}
?>