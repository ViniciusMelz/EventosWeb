<?php
require 'src/controllers/BasicController.php';
require 'src/controllers/EventoController.php';
require 'src/controllers/ParticipacaoEventoController.php';
require 'src/controllers/UsuarioController.php';

$requisicao = $_SERVER['REQUEST_URI'];

switch ($requisicao) {
    case '/eventosWeb/Login':
        BasicController::principal();

        break;
    case '/eventosWeb/Cadastro':
        BasicController::cadastro();

        break;
    case '/eventosWeb/Eventos':
        BasicController::eventos();

        break;
    case '/eventosWeb/criarEvento':
        BasicController::criarEvento();

        break;
    case '/eventosWeb/exportXML':
        BasicController::exportXML();

        break;
    case '/eventosWeb/logout':
        BasicController::logout();

        break;
    case '/eventosWeb/editarEvento':
        BasicController::editarEvento();

        break;
    case '/eventosWeb/participantesEvento':
        BasicController::participantesEvento();

        break;
    case '/eventosWeb/exportPDF':
        BasicController::exportPDF();

        break;

    //API//
    //Eventos//
    case '/eventosWeb/API/evento/listarEventos':
        EventoController::listarEventosAPI();

        break;
    case '/eventosWeb/API/evento/listarEventosUsuarioNaoCadastrado':
        EventoController::buscarEventosUsuarioNaoIncritosAPI();

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
