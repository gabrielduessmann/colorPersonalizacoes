<?php

    // require_once("../paginaSistema/conexaoBanco.php")

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $senha =md5($senha);

    // echo $usuario."<br>";
    // echo $senha;


?>