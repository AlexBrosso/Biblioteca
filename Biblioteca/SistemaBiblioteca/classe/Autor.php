<?php

    class Autor {
        //Atributos
        private $idAutor;
        private $nome;
        private $con;
        private $operacao;

        //Propriedades
        //id Autor
        public function setIdAutor($idAutor){
            $this->idAutor = $idAutor;
        }

        public function getIdAutor(){
            return $this->idAutor;
        }

        //nome
        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getNome(){
            return $this->nome;
        }

        //botao operacao
        public function setOperacao($operacao){
            $this->operacao = strtoupper($operacao);
        }

        public function getOperacao(){
            return $this->operacao;
        }

        private function openConexao(){
            $servidor = "localhost";
            $banco = "biblioteca";
            $usuario = "root";
            $senha = "";
            
            //Conecta ao Banco
            $this->con = mysqli_connect($servidor, $usuario, $senha, $banco);
            $this->con->set_charset("utf8");

            //Verifica erro
            if(mysqli_connect_errno()){
                echo "Falha na criação da conexão com o banco de dados: ". mysqli_connect_error();
            }
        }

        //construtor post
        public function construtorPost(){

            //id
            if (isset($_REQUEST["txtIdAutor"])){
                $this->setIdAutor($_REQUEST["txtIdAutor"]);
            }

            //nome
            if (isset($_REQUEST["txtNome"])){
                $this->setNome($_REQUEST["txtNome"]);
            }
            //autor

            //operacao
            if (isset($_REQUEST["btnOperacao"])){
                $this->setOperacao($_REQUEST["btnOperacao"]);
            }
            else{
                $this->setOperacao("VAZIO");
            }
        }

        //construtor
        function __construct(){
            //cria conexao com banco
            $this->openConexao();

        }

        //metodos

        //inserir
        public function insertAutor(){
            $sql = "INSERT INTO autor (ID, nome) VALUES ( '{$this->idAutor}',
                                                          '{$this->nome}')";
            //Executa o comando sql
            if(!mysqli_query($this->con, $sql)){
                echo '<div class="alert alert-danger page-header mb-0" role="alert">
                <strong>Ocorreu um erro durante o cadastro: </strong>'.mysqli_error($this->con).'</div>';
            }
            else{
                echo  '<div class="alert alert-success page-header mb-0" role="alert">
                <strong>Cadastro bem sucedido!</strong></div>';
            }

        }

        //selecionar
        public function selectAll(){
            $sql = "SELECT * FROM autor ORDER BY ID";

            $resultado = mysqli_query($this->con, $sql);
            $autores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

            mysqli_free_result($resultado);

            return $autores;
    
        }

        //selecionar byID
        public function selectById(){
            $sql = "SELECT * FROM autor WHERE ID = $this->idAutor";

            $resultado = mysqli_query($this->con, $sql);
            $autores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

            mysqli_free_result($resultado);

            $this->idAutor = $autores[0]['ID'];
            $this->nome = $autores[0]['nome'];
        }

        //alterar
        public function updateAutor(){
            $sql = "UPDATE autor SET ID = '{$this->idAutor}', nome = '{$this->nome}' WHERE ID = '{$this->idAutor}'";

            //Executa o comando sql
            if(!mysqli_query($this->con, $sql)){
                $resulta = '<div class="alert alert-danger page-header mb-0" role="alert"><strong>Ocorreu um erro durante a alteração: </strong>'.mysqli_error($this->con).'</div>';

                echo $resulta;
            }
            else{
                $resulta = '<div class="alert alert-success page-header mb-0" role="alert"><strong>Alteração bem sucedida!</strong></div>';

                header("Refresh: 1; url=index.php");

                echo $resulta;
            }
        }
        
        //excluir
        public function deleteAutor(){
            $sql = "DELETE FROM autor WHERE ID = '{$this->idAutor}'";

            //Executa o comando sql
            if(!mysqli_query($this->con, $sql)){
                $resulta = '<div class="alert alert-danger page-header mb-0" role="alert"><strong>Ocorreu um erro durante a remoção: </strong>'.mysqli_error($this->con).'</div>';
                
                echo $resulta;
            }
            else{
                $resulta = '<div class="alert alert-success page-header mb-0" role="alert"><strong>Remoção bem sucedida!</strong></div>';

                header("Refresh: 1; url=index.php");

                echo $resulta;
            }

        }

        //destrutor
        function __destruct(){
            //Fecha a conexão
            mysqli_close($this->con);
        }

    }
?>