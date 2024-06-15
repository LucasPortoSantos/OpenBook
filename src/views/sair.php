<?php
        session_start();
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
?>