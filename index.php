<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link  href="./CSS/landstyle.css" rel="stylesheet">
    <link  href="./CSS/responsiveness-landstyle.css" rel="stylesheet">
    <script>
        function mascara(i,t){

            var v = i.value;

            if(isNaN(v[v.length-1])){
                i.value = v.substring(0, v.length-1);
                return;
            }
            if(t == "cpf"){
                i.setAttribute("maxlength", "14");
                if (v.length == 3 || v.length == 7) i.value += ".";
                if (v.length == 11) i.value += "-";
            }

            }
    </script>
</head>
<body>
    <header>
        <div>
            <h1 class="title"><span>AFC</span></h1>
            <h1 class="title">System</h1>
        </div>

        <ul>
        </ul>
    </header>

    <main>
        <aside>
            <h2>Bem vindo(a) ao</h2>
            <h2><span>Alarm and Fire Control System</span></h2>
            <p>
                Para realizar o login é necessário utilizar uma senha e um CPF previamente cadastrado!
            </p>
            <form action="#" method="POST">
                <input type="text" name="CPF" placeholder="CPF" required oninput="mascara(this, 'cpf')">
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="submit" name="submit" value="Entrar">
            </form>
        </aside>

        <article>
            <img src="./components/images/LOGIN-AFC.png" alt="Proteja!">
        </article>
    </main>

    <?php    
        session_start(); //Início de sessão

        //Caso o botão tenha sido apertado e as credenciais informadas nos campos
        if(isset($_POST['submit']) && !empty($_POST['CPF']) && !empty($_POST['senha'])){
        
            include_once('db_connection.php');//Adesão do arquivo-ponte entre o programa e o banco

            $CPF = $_POST['CPF'];//CPF informado 
            $senha = $_POST['senha'];//Senha informada
            
            //2° parte do tratamento em caso de erro de conexão com o banco, causa explicitada
            if(mysqli_connect_errno()){
                printf("<br> || " . mysqli_connect_error(). " ||");
                die();
            }else{//Em caso de sucesso na conexão, é feita a validação das credenciais
                $result = $connection ->query("Select nome, CPF, senha, email, telefone, nivel_acesso from usuario where CPF = '$CPF' and senha ='$senha';");//Consulta no banco
                $rows = $result -> num_rows;//Quantidade de resultados na verificação
                $db_search_data = mysqli_fetch_assoc($result);
                
                if(strlen($CPF) < 14){
                    exit('<font color="red">CPF inválido!</font>');
                }else if($rows < 1){//Caso não tenha nenhum resultado (significando que o usuário e/ou a senha informada não existe ou está incorreta)
                    unset($_SESSION['CPF']);
                    unset($_SESSION['senha']);
                    session_destroy();
                    exit('<font color="red">CPF e/ou senha incorretos</font>');
                }else{
                    $_SESSION['CPF'] = $CPF;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['nivel_acesso'] = $db_search_data['nivel_acesso'];
                    header('location:home.php');//permite o acesso, as credenciais são mantidas para validação futura
                }
            }
        };
    ?>

</body>
</html>