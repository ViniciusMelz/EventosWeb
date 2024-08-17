<?php 
require 'src/controllers/BasicController.php';

$requisicao = $_SERVER['REQUEST_URI'];

switch ($requisicao) {
    case '/eventosWeb/principal':
        BasicController::principal();

        break;
    /* case 'web2/mvc/carros/marcas/listar':
        MarcaController::listarMarca();
        
        break;
    case 'web2/mvc/carros/marcas/form':
        MarcaController::formInserirMarca();

        break;
    case 'web2/mvc/carros/marcas/inserir':
            MarcaController::inserirMarca();
    
        break;
    case 'web2/mvc/carros/marcas/excluir':
            MarcaController::excluirMarca();
    
        break;
    case 'web2/mvc/carros/marcas/formAlterar':
            MarcaController::formAlterarMarca();
    
        break;
    case 'web2/mvc/carros/marcas/alterar':
            MarcaController::alterarMarca();
    
        break; */
    default:
        BasicController::erro();
        break;
}