<3!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrando...</title>
</head>
<body>
    
<?php
    session_start();

    //Ao apertar o botão de submissão, as informações são repassadas para o cadastro
    if(isset($_POST['submit'])){
            
        include_once('db_connection.php');//Adesão do arquivo-ponte entre o programa e o banco

        $CPF = $_POST['CPF'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nivel_acesso = $_POST['nivel_acesso'];
        //Instrução para executar a adição dos dados ao banco
        mysqli_query($connection, "Insert into usuario(CPF, senha, nome, email, telefone, nivel_acesso) 
                                   values('$CPF', '$senha', '$nome', '$email', '$telefone', '$nivel_acesso')");     
        header('location:tabela-de-registros.php');//Ao inserir, é redirecionado à tabela de contas 
                                               //para uma melhor visualização
    }else{

    };
?>

</body>
</html>