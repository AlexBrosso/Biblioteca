<?php
  include ("classe/Livro.php");
  include ("classe/Autor.php");

  $livro = new Livro;
  $autor = new Autor;

  $livro->construtorPost();
  $autor->construtorPost();

  if($livro->getOperacao() == "CADASTRAR LIVRO"){
    $livro->insertLivro();
  }
  else if($autor->getOperacao() == "CADASTRAR AUTOR"){
    $autor->insertAutor();
  }

  $livroAll = $livro->selectAll();
  $autorAll = $autor->selectAll();

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
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
              <a class="nav-link disabled">Deletar Livro</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Box de Apresentação e Ações-->
    
    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
          <h1 class="col text-center">Bem vindo ao Gereciamento de Dados!</h1>
        <div class="col text-center">
          <h5> O que deseja fazer?</h5>
          <button type="button" class="btn btn-dark align-content-lg-center" id="cadastroLivro">Cadastrar Livro</button>
          <button type="button" class="btn btn-dark align-content-lg-center" id="cadastroAutor">Cadastrar Autor</button>
          <button type="button" class="btn btn-dark align-content-lg-center" id="exibeLivro" onclick=desabilitarButton(id)>Exibir Livros</button>
          <button type="button" class="btn btn-dark align-content-lg-center" id="exibeAutor" onclick=desabilitarButton(id)>Exibir Autores</button>
        </div>

        <!--- Formulário de Cadastro de Livro --->

        <div>
          <form method="POST" id="formLivro">
            <br>
            <div class="form-group ">
              <label for="codigoLivro"><strong>Código: </strong></label>
              <input type="number" class="form-control" id="codigoLivro" placeholder="Digite aqui o código do livro" name="txtIdLivro" required>
            </div>
            <div class="form-group">
              <label for="titulo"><strong>Título: </strong></label>
              <input type="text" class="form-control" id="titulo" placeholder="Digite aqui o titulo do livro" name="txtTitulo" required>
            </div>
            <div class="form-group">
              <label for="genero"><strong>Gênero: </strong></label>
              <input type="text" class="form-control" id="genero" placeholder="Digite aqui o gênero do livro" name="txtGenero" required>
            </div>
            <div class="form-group">
              <label for="quantidade"><strong>Quantidade: </strong></label>
              <input type="number" class="form-control" id="numero" placeholder="Digite aqui a quantidade de livros" name="txtQuantidade" required>
            </div>
            <div class="form-group">
              <label for="autor"><strong>Autor: </strong></label>
              <input type="number" class="form-control" id="autor" placeholder="Digite aqui o ID do autor do livro" name="txtAutor" required>
              <p><small class="text-muted"><strong>&nbsp;&nbsp;&nbsp;Caso possua dúvidas em relação ao id, consulte a tabela de Autores</strong></small></p>
            </div>
            <input type="submit" class="btn btn-primary btn-dark align-content-lg-center " value="Cadastrar Livro" name="btnOperacao"/>
          </form> 
        </div>

        <!--- Formulário de Cadastro de Autores --->
      
        <div>
          <form  method="POST" id="formAutor">
            <br>
            <div class="form-group ">
              <label for="codigoAutor"><strong>Código: </strong></label>
              <input type="number" class="form-control" id="codigoAutor" placeholder="Digite aqui o código do autor" name="txtIdAutor" required>
            </div>
            <div class="form-group">
              <label for="nome"><strong>Nome: </strong></label>
              <input type="text" class="form-control" id="nome" placeholder="Digite aqui o nome do autor" name="txtNome" required>
            </div>
            <input type="submit" class="btn btn-primary btn-dark align-content-lg-center" value="Cadastrar Autor" name="btnOperacao"/>
          </form> 
        </div>
      </div >

      <!-- Sem formulários -->

      <div id="NoT">
        <img src="./img/PilhaLivros1.png" width="200" height="200" class="center">
        <h5 class="col text-center">Nenhuma tabela selecionada!</h5><br><br>
      </div>

      <!-- Tabela Livro -->

      <div id="DivLivrosT">
        <div class=" page-header">
          <h3 class="col text-center">Livros Cadastrados</h3>
          <br>
        </div>
        <div class="row justify-content-center">
          <div class="col-xs-2 col-sm-2 col-md-4 col-lg-12">
            <table class="table table-responsive">
              <thead>
                <tr>
                  <th >ID</th>
                  <th style="width: 50%" >Título</th>
                  <th style="width: 20%">Gênero</th>
                  <th>Quantidade</th>
                  <th style="width: 40%">Autor</th>
                  <th>Alterar</th>
                  <th>Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php

                    // ADICIONAR O CÓDIGO PHP
                    // Exibindo o valor
                    foreach($livroAll as $liv) {   
                        $idLivro = $liv['ID'];
                        $titulo = $liv['titulo'];
                        $genero = $liv['genero'];
                        $quantidade = $liv['quantidade'];
                        $autorLivro =  $liv['autor_ID'];
                        
                        echo "<tr>";
                        echo "<td class='align-middle'>$idLivro</td>";
                        echo "<td class='align-middle'>$titulo</td>";
                        echo "<td class='align-middle'>$genero</td>";
                        echo "<td class='align-middle'>$quantidade</td>";
                        echo "<td class='align-middle'>$autorLivro</td>";
                        echo "<td><a href='AlterarLivro.php?txtIdLivro={$idLivro}'><img src='./img/Alterar.png' width='20' height='20' class='center'></td></a>";
                        echo "<td><a href='DeletarLivro.php?txtIdLivro={$idLivro}'><img src='./img/Delete.png' width='20' height='20' class='center'></td></a>";
                        echo "</tr>";
                    }

                ?>
              </tbody>
            </table>
          </div>
          <br>
        </div>
      </div>
      <br>


      <div id="DivAutoresT">
        <div class=" page-header">
          <h3 class="col text-center">Autores Cadastrados</h3>
          <br>
        </div>
        <div class="row justify-content-center">
          <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
            <table class="table table-responsive ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th class="col-3">Nome</th>
                  <th>Alterar</th>
                  <th>Excluir</th>
                </tr>
              </thead>
              <tbody>
              <?php

                // ADICIONAR O CÓDIGO PHP
                // Exibindo o valor
                foreach($autorAll as $aut) {   
                    $idAutor = $aut['ID'];
                    $nome = $aut['nome'];
                    
                    echo "<tr>";
                    echo "<td>$idAutor</td>";
                    echo "<td class='col-3'>$nome</td>";
                    echo "<td><a href='AlterarAutor.php?txtIdAutor={$idAutor}'><img src='./img/Alterar.png' width='20' height='20' class='center'></td></a>";
                    echo "<td><a href='DeletarAutor.php?txtIdAutor={$idAutor}'><img src='./img/Delete.png' width='20' height='20' class='center'></td></a>";
                    echo "</tr>";
                }

              ?>
              </tbody>
            </table>
          </div>
          <br>
        </div>
      </div>


      <br>
    </div>
  </body>    
</html>