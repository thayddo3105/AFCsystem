<?php
    //Mecanismo do botão de saída
    session_start();
    unset($_SESSION['CPF']);
    unset($_SESSION['senha']);
    session_destroy();
    header("location:index.php");
?>