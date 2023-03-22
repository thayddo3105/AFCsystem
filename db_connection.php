<?php
  //Configuração - com adição da porta compatível - para a conexão com o banco web
  $connection = new mysqli('sql202.epizy.com','epiz_33246059','oWapAwQrZZKbtL','epiz_33246059_socorro');

  //Configuração (host, nome de usuário, senha e nome do banco, respectivamente) para a conexão com o banco local
  //$connection = new mysqli('localhost','root','','468398');
  
  //1° parte do tratamento em caso de erro de conexão com o banco (causa do erro explicitada na segunda parte)
  if(mysqli_connect_errno()){
      printf("Erro ao conectar-se com o banco de dados " . mysqli_connect_errno());
  }else{
  }
?>