function desabilitarButton(id){         //Função para desabilitar temporariamente os botões de esconder e exibir tabelas, deixando que as animações se concluam.    
    $("#"+id).click(function() {
        $(this).prop("disabled",true);
    });
    //Reativar o botão após 0.5 segundos
    $("#"+id).click(function() {
        var btn = this;
        setTimeout(function() {
            btn.disabled =  false; 
        }, 500);
    });
}

$( document ).ready(function() {
    setTimeout(function() {             //Função para esconder o alert após 4 segundos;
        $('.alert').hide("milliseconds", "linear"); 
    }, 4000);

    var x = 0; //Váriavel X para a Tabela Livros;
    var y = 0; //Váriavel Y para a Tabela Autores;


    $("#formLivro").hide();             //                                              //
    $("#formAutor").hide();             //     Esconder Formulários e Tabelas           //
    $("#DivLivrosT").hide();            //          Ao inciar a página                  //
    $("#DivAutoresT").hide();           //                                              //


    $("#cadastroLivro").click(function(){  //Função para exibir/esconder o Form de Livro;
        $("#formLivro").toggle("milliseconds", "swing");
        $('#cadastroAutor').toggle("milliseconds", "swing"); //Retira/Coloca o botão de Cadastrar Autor, para não interferir na página;
        
    });


    $("#cadastroAutor").click(function(){ //Função para exibir/esconder o Form de Autor;
        $("#formAutor").toggle("milliseconds", "swing");
        $('#cadastroLivro').toggle("milliseconds", "swing"); //Retira/Coloca o botão de Cadastrar Livro, para não interferir na página;

    });


    $("#exibeLivro").click(function(){ //Função para exibir/esconder Tabela de Livros;
        if (x == 0){
            x++;                                                //Soma uma antes da tabela aparecer;
            $("#DivLivrosT").toggle("milliseconds", "linear");  //Exibe tabela;
            $("#NoT").hide("slow");                             //Esconde a mensagem de "Sem tabelas para mostrar";
            $("#exibeLivro").html("Esconder Livros");           //Altera o nome do botão;
        }
        else{
            x--;                                                //Subtrai um antes da tabela desaparecer;
            $("#DivLivrosT").toggle("milliseconds", "linear");  //Esconde tabela;
            if(x == 0 && y == 0){                               //Caso Tabela Livros e Tabela Autores estejam esocondidas;
                $("#NoT").show("slow");                             //Mostra a mensagem de "Sem tabelas para mostrar";
            }
            $("#exibeLivro").html("Exibir Livros");             //Altera o nome do botão;
        }
    });

    $("#exibeAutor").click(function(){//Função para exibir/esconder Tabela de Autores;
        if (y == 0){
            y++;                                                  //Soma uma antes da tabela aparecer;  
            $("#DivAutoresT").toggle("milliseconds", "linear");   //Exibe tabela;
            $("#NoT").hide("slow");                               //Esconde a mensagem de "Sem tabelas para mostrar";  
            $("#exibeAutor").html("Esconder Autores");            //Altera o nome do botão;
        }
        else{
            y--;                                                  //Subtrai um antes da tabela desaparecer;
            $("#DivAutoresT").toggle("milliseconds", "linear");   //Esconde tabela;
            if(x == 0 && y == 0){                                 //Caso Tabela Livros e Tabela Autores estejam esocondidas;
                $("#NoT").show("slow");                               //Mostra a mensagem de "Sem tabelas para mostrar";          
            }
            $("#exibeAutor").html("Exibir Autores");              //Altera o nome do botão;
        }
    }); 
    
    $("#DeleteClick").click(function(){ //Função para exibir um Alert ao clicar no botão de Deletar Autor;
        alert("Caso o autor esteja vinculado a um livro, a ação não será executada! Pois as obras vinculadas a ele devem ser exlcuidas primeiro.");
    });

});