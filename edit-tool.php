<?php
    include_once('db_connection.php');//Adesão do arquivo-ponte entre o programa e o banco
    
    //Ao apertar o botão de submissão, as informações são repassadas para a edição das informações cadastrais
    if(isset($_POST['update'])){
        $CPF = $_POST['CPF'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nivel_acesso = $_POST['nivel_acesso'];

        //Atualização das informações(com excessão do CPF);
        $result = $connection -> query("Update usuario set senha='$senha', nome='$nome', email='$email', telefone='$telefone', nivel_acesso='$nivel_acesso' where CPF='$CPF'");
        header("location:tabela-de-registros.php");
    };
?>