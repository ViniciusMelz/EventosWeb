<?php 
require 'src/controllers/BasicController.php';
require 'src/controllers/EventoController.php';
require 'src/controllers/ParticipacaoEventoController.php';
require 'src/controllers/UsuarioController.php';

$requisicao = $_SERVER['REQUEST_URI'];

switch ($requisicao) {
    case '/eventosWeb/':
        BasicController::principal();

        break;
    case '/eventosWeb/API/evento/listarEventos':
        EventoController::listarEventosAPI();
        
        break;
    case '/eventosWeb/API/participacao/listarParticipacoes':
        ParticipacaoEventoController::buscarParticipacaoEventoAPI();

        break;
    case '/eventosWeb/API/participacao/inserirParticipacao':
        ParticipacaoEventoController::inserirParticipacaoEventoAPI();
    
        break;
    case '/eventosWeb/API/usuario/autenticarUsuario':
        UsuarioController::autenticarUsuarioAPI();
    
        break;
    case '/eventosWeb/API/usuario/inserirUsuario':
        UsuarioController::inserirUsuarioAPI();
    
        break;
    default:
        BasicController::erro();
        break;
}