<?php
  include ("classe/Autor.php");

  $autor = new Autor;

  $autor->construtorPost();

  if($autor->getOperacao() == "DELETAR AUTOR"){
    $autor->deleteAutor();
    //header("Location:Index.php");
  }
  else if($autor->getOperacao() == "CANCELAR"){
    header("Location:Index.php");
  }
  else{
    $autor->selectById();
  }

  $autorAll = $autor->selectAll();

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
              <a class="nav-link active">Deletar Autor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Deletar Livro</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Box de Apresentação e Ações-->

    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
        <h1 class="col text-center">Remoção de Autor</h1>
        <div class="col text-center">
          <h5>Tem certez que deseja excluir esse autor?</h5>
        </div>

        <!--- Formulário de Remoção do Autor --->

        <div>
          <form  method="POST" id="deleteAutor">
            <br>
            <div class="form-group ">
              <label for="codigoAutor"><strong>Código: </strong></label>
              <input type="number" class="form-control" id="codigoAutor" placeholder="Digite aqui o código do autor" name="txtIdAutor" value="<?php echo $autor->getIdAutor(); ?>" readonly="" required>
            </div>
            <div class="form-group">
              <label for="nome"><strong>Nome: </strong></label>
              <input type="text" class="form-control" id="nome" placeholder="Digite aqui o nome do autor" name="txtNome" value="<?php echo $autor->getNome(); ?>" readonly="" required>
            </div>
            <input type="submit" class="btn btn-primary btn-dark " value="Deletar Autor" name="btnOperacao" id="DeleteClick"/>
            <input type="submit" class="btn btn-primary btn-dark " value="Cancelar" name="btnOperacao"/>
          </form> 
        </div>
      </div>
    </div>

  </body>    
</html>