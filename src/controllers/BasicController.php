<?php

class BasicController{
    public static function principal(){
        $title = 'Pagina Principal';
        $content = 'Bem vindo a página principal.';

        require __DIR__.'..\views\view1';
        
    }

    public static function erro(){
        $title = 'Pagina Erro';
        $content = 'Aconteceu um erro :(.';

        require __DIR__.'/../views/layout.php';
        
    }
}