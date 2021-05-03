<?php
  include ("classe/Livro.php");

  $livro = new Livro;

  $livro->construtorPost();

  if($livro->getOperacao() == "DELETAR LIVRO"){
    $livro->deleteLivro();
    //header("Location:Index.php");
  }
  else if($livro->getOperacao() == "CANCELAR"){
    header("Location:Index.php");
  }
  else{
    $livro->selectById();
  }

?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-9">
        <meta name="author" content="Alex Lobato Brosso">

        <title>Trabalho PW2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--CSS Bootstrap-->
        <link href="./css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./css/Document.css" rel="stylesheet">


        <!--JS Bootstrap-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>

        <!--JS/Jquery-->
        <script src="./js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="./js/bibliotecaJS.js" type="text/javascript"></script> 

    </head>
    <body>


    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
      <div class="container">
        <a class="navbar-brand" href="Index.php"><strong>Biblioteca PW2</strong></a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="Index.php"><strong>Home</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Alterar Autor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Alterar Livro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Deletar Autor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active">Deletar Livro</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Box de Apresentação e Ações-->

    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
        <h1 class="col text-center">Remoção de Livros</h1>
        <div class="col text-center">
          <h5> Tem certez que deseja excluir esse livro?</h5>
        </div>

        <!--- Formulário de Alteração de Livro --->

        <div>
          <form method="POST" id="deleteLivro">
            <br>
            <div class="form-group ">
              <label for="codigoLivro"><strong>Código: </strong></label>
              <input type="number" class="form-control" id="codigoLivro" placeholder="Digite aqui o código do livro" name="txtIdLivro" value="<?php echo $livro->getIdLivro(); ?>" readonly="" required>
            </div>
            <div class="form-group">
              <label for="titulo"><strong>Título: </strong></label>
              <input type="text" class="form-control" id="titulo" placeholder="Digite aqui o titulo do livro" name="txtTitulo" value="<?php echo $livro->getTitulo(); ?>" readonly="" required>
            </div>
            <div class="form-group">
              <label for="genero"><strong>Gênero: </strong></label>
              <input type="text" class="form-control" id="genero" placeholder="Digite aqui o gênero do livro" name="txtGenero" value="<?php echo $livro->getGenero(); ?>" readonly=""  required>
            </div>
            <div class="form-group">
              <label for="quantidade"><strong>Quantidade: </strong></label>
              <input type="number" class="form-control" id="numero" placeholder="Digite aqui a quantidade de livros" name="txtQuantidade" value="<?php echo $livro->getQuantidade(); ?>" readonly=""  required>
            </div>
            <div class="form-group">
              <label for="autor"><strong>Autor: </strong></label>
              <input type="number" class="form-control" id="autor" placeholder="Digite aqui o ID do autor do livro" name="txtAutor" value="<?php echo $livro->getAutorLivro(); ?>" readonly="" required>
            </div>
            <input type="submit" class="btn btn-primary btn-dark  " value="Deletar Livro" name="btnOperacao"/>
            <input type="submit" class="btn btn-primary btn-dark " value="Cancelar" name="btnOperacao"/>
          </form> 
        </div>
      </div>
    </div>
  </body>    
</html>