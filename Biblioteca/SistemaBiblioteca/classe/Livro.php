<?php

    class Livro {
        //Atributos
        private $idLivro;
        private $titulo;
        private $genero;
        private $quantidade;
        private $autorLivro;
        private $operacao;
        private $con;

        //Propriedades
        //id Livro
        public function setIdLivro($idLivro){
            $this->idLivro = $idLivro;
        }

        public function getIdLivro(){
            return $this->idLivro;
        }

        //título
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        //gênero
        public function setGenero($genero){
            $this->genero = $genero;
        }

        public function getGenero(){
            return $this->genero;
        }

        //quantidade
        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }

        public function getQuantidade(){
            return $this->quantidade;
        }

        //autorLivro
        public function setAutorLivro($autorLivro){
            $this->autorLivro = $autorLivro;
        }

        public function getAutorLivro(){
            return $this->autorLivro;
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
            if (isset($_REQUEST["txtIdLivro"])){
                $this->setIdLivro($_REQUEST["txtIdLivro"]);
            }

            //titulo
            if (isset($_REQUEST["txtTitulo"])){
                $this->setTitulo($_REQUEST["txtTitulo"]);
            }

            //gênero
            if (isset($_REQUEST["txtGenero"])){
                $this->setGenero($_REQUEST["txtGenero"]);
            }

            //quantidade
            if (isset($_REQUEST["txtQuantidade"])){
                $this->setQuantidade($_REQUEST["txtQuantidade"]);
            }

            //autor
            if(isset($_REQUEST["txtAutor"])){
                $this->setAutorLivro($_REQUEST["txtAutor"]);
            }

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
        public function insertLivro(){
            $sql = "INSERT INTO livro (ID, titulo, genero, quantidade, autor_ID) VALUES ( '{$this->idLivro}',
                                                                                        '{$this->titulo}',
                                                                                        '{$this->genero}',
                                                                                        '{$this->quantidade}',
                                                                                        '{$this->autorLivro}')";

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
            $sql = "SELECT l.ID as ID, l.titulo as titulo, l.genero as genero, l.quantidade as quantidade, a.nome as autor_ID  FROM livro l, autor a WHERE l.autor_ID = a.ID ORDER BY l.ID";

            $resultado = mysqli_query($this->con, $sql);
            $livros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

            mysqli_free_result($resultado);

            return $livros;
    
        }

        //selecionar byID
        public function selectById(){
            $sql = "SELECT * FROM livro WHERE ID = $this->idLivro";

            $resultado = mysqli_query($this->con, $sql);
            $livros = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

            mysqli_free_result($resultado);

            $this->idLivro = $livros[0]['ID'];
            $this->titulo = $livros[0]['titulo'];
            $this->genero = $livros[0]['genero'];
            $this->quantidade = $livros[0]['quantidade'];
            $this->autorLivro = $livros[0]['autor_ID'];
    
        }

        //alterar
        public function updateLivro(){
            $sql = "UPDATE livro SET titulo = '{$this->titulo}', genero = '{$this->genero}', quantidade = '{$this->quantidade}', autor_ID = '{$this->autorLivro}' WHERE ID = '{$this->idLivro}'";

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
        public function deleteLivro(){
            $sql = "DELETE FROM livro WHERE ID = '{$this->idLivro}'";

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