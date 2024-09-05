<?php
session_start();
if(!isset($_SESSION['eventos'])){
    header('location: /eventosWeb/Eventos');
}else{
    $eventos = $_SESSION['eventos'];
    if(count($eventos) > 0){

        header('Content-type: text/xml');
        $eventosXML = new SimpleXMLElement("<eventos></eventos>");

        for ($i=0; $i < count($eventos); $i++) { 
            $eventoXML = $eventosXML->addChild('evento');

            $eventoXML->addChild('id', $eventos[$i]['id']);
            $eventoXML->addChild('titulo', $eventos[$i]['titulo']);
            $eventoXML->addChild('descricao', $eventos[$i]['descricao']);
            $eventoXML->addChild('localEvento', $eventos[$i]['localEvento']);
            $eventoXML->addChild('dataEvento', DateTime::createFromFormat('Y-m-d', $eventos[$i]['dataEvento'])->format('d/m/Y'));
            $eventoXML->addChild('registroCriado', $eventos[$i]['registroCriado']);

            ob_clean();
            echo $eventosXML->asXML();
        }
    }else{
        echo 'ERRO: Nenhum Evento Existente';
    }
}