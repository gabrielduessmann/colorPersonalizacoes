<?php

session_start();

unset($_SESSION['idLogado']);
unset($_SESSION['usuarioLogado']);
unset($_SESSION['nivelLogado']);

header("Location: ../websiteTabs/login.php");
 ?>
