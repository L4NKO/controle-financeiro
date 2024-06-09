<?php

class UtilDAO{

    private static function IniciarSessao(){

        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function CriarSessao($cod, $nome){

        self::IniciarSessao();

        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    
    }

    public static function CodigoLogado(){
        self::IniciarSessao();
    return $_SESSION['cod'];

    }

    public static function NomeLogado(){
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function ChamarPagina($paginas){
        header("location: $paginas.php");
        exit;
    }
    public static function Deslogar(){
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        self::ChamarPagina('login');
    }

    public static function VerificarLogado(){
        self::IniciarSessao();
        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
            self::ChamarPagina('login');
        }
    }

public static function AtualizarSessaoNome($nome){
    self::IniciarSessao();
    $_SESSION['nome'] = $nome;
}

}