<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de registros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="./CSS/regdatastyle.css" rel="stylesheet">
</head>
<body>
    <?php session_start();

    //Validação inicial para o caso das credenciais não terem sido definidas no login
    if((!isset($_SESSION['CPF']) == true) || (!isset($_SESSION['senha']) == true)){
      unset($_SESSION['CPF']);
      unset($_SESSION['senha']);
      session_destroy();
      header('location:index.php');
    }else if(($_SESSION['nivel_acesso']) == '0'){//Caso o acesso seja validado, os dados cadastrais disponíveis no banco são listados 
      header('location:home.php');
    }else{   
      $permission_level = $_SESSION['nivel_acesso'];
      include_once('db_connection.php');
      $result = $connection ->query("Select nome, CPF, senha, email, telefone, nivel_acesso from usuario order by nome asc");
    }
    ?>

    <header>
        <div>
            <h1 class="title"><span>AFC</span></h1>
            <h1 class="title">System</h1>
        </div>

        <ul>
            <a href="home.php" class="home"><li>Home</li></a>
            <a href="formulario-de-cadastro.php" class="register"><li>Cadastrar</li></a>
           <a href="tabela-de-ocorrencias.php" class="register"><li>Tabela de ocorrências</li></a>
            <a href="exit_button.php" class="exit"><li>Sair</li></a>

        </ul>
    </header>
    <div class="table-responsive-md">
        <table class="table data-table text-white table-borderless">
            <thead>
                <tr>
                <th scope="col">Nome:</th>
                <th scope="col">CPF:</th>
                <th scope="col">Senha:</th>
                <th scope="col">Email:</th>
                <th scope="col">Telefone:</th>
                <th scope="col">Acesso de:</th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php

                    while($user_data = mysqli_fetch_assoc($result)){
                        $level =  $user_data['nivel_acesso'];
                        if($level == "1"){
                            $level = "Administrador";
                            $nivel_acessotab = $user_data['nivel_acesso'];
                        }else{
                            $level = "Usuário";
                            $nivel_acessotab = $user_data['nivel_acesso'];
                        }
                        echo "<tr>";
                            echo "<td>".$user_data['nome']."</td>";
                            echo "<td>".$user_data['CPF']."</td>";
                            echo "<td>".$user_data['senha']."</td>";
                            echo "<td>".$user_data['email']."</td>";
                            echo "<td>".$user_data['telefone']."</td>";
                            echo "<td>".$level."</td>";
                            echo "<td>
                                    <a class='btn btn-sm btn-primary aligning' href='formulario-de-edicao.php?CPF=$user_data[CPF]' title='Alterar''>
                                      <svg xmlns='http://www.w3.org/2000/svg' width='21' height='26' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 15 15'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                      </svg>
                                    </a>
                                  </td>
                                  <td>
                                  <a class='btn btn-sm btn-danger' href='delete-tool.php?CPF=$user_data[CPF]' title='Deletar''>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                    </svg>
                                  </a>
                                </td>";
                        echo "</tr>";
                        };
?>

</body>
</html>