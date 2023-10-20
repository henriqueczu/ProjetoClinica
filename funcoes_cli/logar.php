<?php

session_start();
require_once 'conexao.php';

class login {
    
    private $conexao;
    
    public function __construct() {
        $this->conexao = new conexao("localhost", "root", "", "clinica");
        if($this->conexao->conectar() == false){
            echo "ERRO: ".mysqli_error();
        }   
    }
    
    function verificarLogado(){
        if(!isset($_SESSION["logado"])){
            header("index_login.php");
            exit();
        }
    }
    
    function Logar($email,$senha){
        $q_cliente = $this->conexao->executaQuery("SELECT * FROM usuario_clinica WHERE email_cliente = '$email' AND senha_cliente = '$senha'");
        $linhas = mysqli_num_rows($q_cliente);
        echo $linhas;
        if($linhas == 1){
            $d_cliente = mysqli_fetch_array($q_cliente);
            $_SESSION['email_cliente'] = $d_cliente['email_cliente'];
            $_SESSION['senha_cliente'] = $d_cliente['senha_cliente'];
            $_SESSION['logado']=1;
            header("Location:../cadastro.php");
        } else {
            $erro = "Senha e/ou email errado(s)!!!";
            return $erro;
        }
    }
}
?>