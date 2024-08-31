<?php
require 'src/controllers/BasicController.php';
require 'src/controllers/EventoController.php';
require 'src/controllers/ParticipacaoEventoController.php';
require 'src/controllers/UsuarioController.php';

$requisicao = $_SERVER['REQUEST_URI'];

switch ($requisicao) {
    case '/EventosWeb/':
        BasicController::principal();

        break;
    case '/EventosWeb/Cadastro':
        BasicController::cadastro();

        break;

        //API//
        //Eventos//
    case '/eventosWeb/API/evento/listarEventos':
        EventoController::listarEventosAPI();

        break;

        //Participações Eventos//
    case '/eventosWeb/API/participacao/listarParticipacoes':
        ParticipacaoEventoController::buscarParticipacaoEventoAPI();

        break;
    case '/eventosWeb/API/participacao/inserirParticipacao':
        ParticipacaoEventoController::inserirParticipacaoEventoAPI();

        break;
    case '/eventosWeb/API/participacao/deletarParticipacao':
        ParticipacaoEventoController::deletarParticipacaoEventoAPI();

        break;
    case '/eventosWeb/API/participacao/buscarParticipacaoUsuarioEspecifico':
        ParticipacaoEventoController::BuscarParticipacaoEventoUsuarioEspecificoAPI();

        break;

        //Usuário//
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
