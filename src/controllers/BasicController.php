<?php

class BasicController{
    public static function principal(){
        require __DIR__.'/../views/Login.php';
        
    }

    public static function cadastro(){
        require __DIR__.'/../views/Cadastro.php';
        
    }

    public static function eventos(){
        require __DIR__.'/../views/Eventos.php';
        
    }

    public static function criarEvento(){
        require __DIR__.'/../views/CriarEvento.php';
        
    }

    public static function exportXML(){
        require __DIR__.'/../views/ExportXml.php';
        
    }

    public static function erro(){
        $title = 'Pagina Erro';
        $content = 'Aconteceu um erro :(';

        require __DIR__.'/../views/layout.php';
        
    }
}