<?php
class EventoController{
    /* public static function listarEventos() : void {
        require 'src/models/MarcaModel.php';

        $marca = new MarcaModel();
        $listaMarcas = $marca->getMarca();

        //chamar a view para mostrar a lista de marcas
        require('src/views/marcasView.php');
    }

    public static function formInserirMarca() : void {
        $acao = '/mvc/carros/marcas/inserir';
        $funcao = 'Cadastro de Marcas';

        require ('src/views/marcaForm.php');
    }

    public static function formAlterarMarca() : void {
        if(($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['id']) )&& (isset($_POST['nome']))){
            $acao = '/mvc/carros/marcas/alterar';
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $funcao = 'Alteração da marca '.$nome;

            require ('src/views/marcaForm.php');
        }
    }

    public static function inserirMarca() : void {
        if(($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['nome']))){

            require('src/models/MarcaModel.php');
            $marca = new MarcaModel();
            $retornoInserir = $marca->inserirMarca($_POST['nome']);

            header('location: /mvc/carros/marcas/listar');
        }else{
            echo 'Ocorreu um erro ao inserir a marca';
        }
        
    }

    public static function excluirMarca() : void {
        if(($_SERVER['REQUEST_METHOD']=== 'POST') && (isset($_POST['id']))){
            require('src/models/MarcaModel.php');
            $marca = new MarcaModel();
            $retornoExcluir = $marca->excluirMarca($_POST['id']);

            header('location: /mvc/carros/marcas/listar');
        }else{
            echo 'Ocorreu um erro ao excluir a marca';
        }
    }

    public static function alterarMarca() : void {
        if(($_SERVER['REQUEST_METHOD']=== 'POST') && (isset($_POST['id']) && (isset($_POST['nome'])))){
            require('src/models/MarcaModel.php');
            $marca = new MarcaModel();
            $retornoExcluir = $marca->alterarMarca($_POST['id'], $_POST['nome']);

            header('location: /mvc/carros/marcas/listar');
        }else{
            echo 'Ocorreu um erro ao excluir a marca';
        }
    } */
}