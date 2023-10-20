<?php

class conexao {
    // Atributos da classe conexão
    private $host;
    private $usuario;
    private $senha;
    private $banco;
    private $conexao;
    
    // Construtir da classe conexão.Inicia as variaveis do objeto conexão
    
    function __construct($host, $usuario, $senha, $banco) {
        $this->host     = $host;
        $this->usuario  = $usuario;
        $this->senha    = $senha;
        $this->banco    = $banco;
    }
    
    // Método que conecta ao banco de dados
    // Retorna True (verdadeiro) se a conexão foi realizada co  sucesso
    
    function conectar(){
        // Realiza a conexao ao banco de dados
        $this->conexao = mysqli_connect($this->host,$this->usuario,$this->senha,$this->banco);
        // Caso tenha ocorrido algum erro, avisa o usuário sobre o erro
        if(mysqli_connect_errno())
        {
            return false;
        }
        else
        {
            // Se deu certo a conexão
            mysqli_query($this->conexao, "SET NAMES 'utf8';");
            return true;
            
        }
    }
    
    // Função que executa queries (Consultas) no banco de dados
    function executaQuery($sql){
        return mysqli_query($this->conexao,$sql);
    }
    // Função que executa uma busca e retorna o primeiro registro encontrado.
    function PrimeiroRegistroQuery($query){
        $linhas = $this->executaQuery($query);
        // Retorna a primeira linha
        return mysqli_fetch_array($linhas);
    }   
   
}


?>
