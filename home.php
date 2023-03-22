<?php session_start();

//Validação inicial para o caso das credenciais não terem sido definidas no login
if((!isset($_SESSION['CPF']) == true) || (!isset($_SESSION['senha']) == true)){
    unset($_SESSION['CPF']);
    unset($_SESSION['senha']);
    session_destroy();
    header('location:index.php');
}else{
    $permission_level = $_SESSION['nivel_acesso'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link  href="./CSS/homestyle.css" rel="stylesheet">
    <link  href="./CSS/responsiveness-landstyle.css" rel="stylesheet">
</head>
<style>
    .module:hover{
    color: rgb(255, 255, 84);
    padding: 3px;
    background-color: rgb(255, 79, 123);
    transition: 0.3s all;
}
</style>
<body>
    <header>
            <div>
                <h1 class="title"><span>AFC</span></h1>
                <h1 class="title">System</h1>
            </div>
            <ul>
                <?php if($permission_level): ?> <!-- Validação de permissão --> 
                    <a href="./submit.php" class="module">
                    <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 2 16 15">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg>    
                    Módulo E-mail</li></a>
                    <a href="formulario-de-cadastro.php" class="register"><li>Cadastrar</li></a>          
                    <a href="tabela-de-registros.php" class="reg-data"><li>Dados cadastrais</li></a>
                <?php endif; ?>
                <a href="tabela-de-ocorrencias.php" class="reg-data"><li>Tabela de ocorrências</li></a> 
                <a href="exit_button.php" class="exit"><li>Sair</li></a>
            </ul>
    </header>
        <main>
        <aside>
            <h2 >Seja <span style="color: #2cd143;">bem vindo(a)</span>!</h2>
            <p>
                <?php if($permission_level): ?> <!-- Validação de permissão --> 
                    Para começar a utilizar o sistema AFC basta escolher uma das ferramentas de gerenciamento acima na barra de navegação, seja para visualizar contatos ou para cadastrá-los, de forma simples!
                <?php endif; ?>

                <?php if(!$permission_level): ?> <!-- Validação de permissão --> 
                    É necessário possuir algumas permissões a mais para utilizar totalmente as ferramentas disponíveis... porém, fique a vontade!
                <?php endif; ?> 
            </p>
        </aside>

        <article>
        <?php if($permission_level): ?> <!-- Validação de permissão --> 
            <img src="./components/images/HOMEPAGE-AFC.png" alt="Una-se!">          
        <?php endif; ?> 
        <?php if(!$permission_level): ?> <!-- Validação de permissão --> 
            <img src="./components/images/HOMEPAGE-AFC_user.png" alt="Una-se!">          
        <?php endif; ?> 
        </article>
    </main>
</body>
</html>