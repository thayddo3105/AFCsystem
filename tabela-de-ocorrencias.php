<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de ocorrencias</title>
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
    }else{   
      $permission_level = $_SESSION['nivel_acesso'];
      include_once('db_connection.php');
      $result = $connection ->query("Select Num_Ocorrencia, Num_Lab, Temperatura, Gas_Fumaca, Data, Hora from ocorrencias order by Num_Ocorrencia asc");
    }
    ?>

    <header>
        <div>
            <h1 class="title"><span>AFC</span></h1>
            <h1 class="title">System</h1>
        </div>

        <ul>
            <a href="home.php" class="home"><li>Home</li></a>
            <?php if($permission_level): ?> <!-- Validação de permissão --> 
                <a href="formulario-de-cadastro.php" class="register"><li>Cadastrar</li></a>
                <a href="tabela-de-registros.php" class="register"><li>Dados cadastrais</li></a>
            <?php endif; ?>
            <a href="exit_button.php" class="exit"><li>Sair</li></a>

        </ul>
    </header>
    <div class="table-responsive-md">
        <table class="table data-table text-white table-borderless">
            <thead>
                <tr>
                <th scope="col">Número da ocorrência:</th>
                <th scope="col">Número do laboratório:</th>
                <th scope="col">Temperatura registrada:</th>
                <th scope="col">Gás detectado:</th>
                <th scope="col">Data:</th>
                <th scope="col">Hora:</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php

                    while($reg_data = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                            echo "<td>".$reg_data['Num_Ocorrencia']."</td>";
                            echo "<td>".$reg_data['Num_Lab']."</td>";
                            echo "<td>".$reg_data['Temperatura']."</td>";
                            echo "<td>".$reg_data['Gas_Fumaca']."</td>";
                            echo "<td>".$reg_data['Data']."</td>";
                            echo "<td>".$reg_data['Hora']."</td>";
                        echo "</tr>";  
                        };
?>

</body>
</html>