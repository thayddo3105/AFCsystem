<?php
    include_once('db_connection.php');//Adesão do arquivo-ponte entre o programa e o banco

    $CPF = $_GET['CPF'];//CPF informado
    $result = $connection->query("Select * from usuario where CPF='$CPF'");//Consulta no banco
   
    if($result -> num_rows > 0){//Resultados obtidos com base no CPF informado

        $deleteresult = $connection -> query("Delete from usuario where CPF='$CPF'");//Instrução de exclusão do banco
    
        header('location:tabela-de-registros.php');//Ao inserir, é redirecionado à tabela de contas 
                                                   //para uma melhor visualização                
    };
?>