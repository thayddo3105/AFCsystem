
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se no AFC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="./CSS/regformstyle.css" rel="stylesheet">
</head>
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
   if(t === "tel"){
  if (v.length === 1) i.value = "(" + i.value;
  if (v.length === 3) i.value += ") ";
  if(v[5] == 9){
     i.setAttribute("maxlength", "15");
     if (v.length === 10) i.value += "-";
  }else{
     i.setAttribute("maxlength", "14");
     if (v.length === 9) i.value += "-";
  }
}
}
</script>
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
};
?>
        <!-- Formulário (ou caixa) de registro ps: necessário organizar a identação -->
    <header>
        <a class='title' href="tabela-de-registros.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
          </svg>
        </a>
    </header>
    <div class="form-body">
    <div class="container">
    <div class="title">Formulário de Registro</div>
    <div class="content">
      <form action="regformconnection.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nome</span>
            <input type="text" name="nome" required>
          </div>
          <div class="input-box">
            <span class="details">CPF</span>
            <input type="text" name="CPF" required oninput="mascara(this, 'cpf')">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Senha</span>
            <input type="text" name="senha" required>
          </div>
          <div class="input-box">
            <span class="details">Telefone</span>
            <input type="text" name="telefone" required oninput="mascara(this, 'tel')">
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="nivel_acesso" value="0" id="dot-1">
          <input type="radio" name="nivel_acesso" value="1" id="dot-2">
          <span class="gender-title">Nível de Acesso</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Usuário</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Adiministrador</span>
          </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Registrar">
        </div>
      </form>
    </div>
  </div>
</div>
<!------------------------------------------------------->




</body>
</html>