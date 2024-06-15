<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
    include_once('../config.php');
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM TbUsuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $result = mysqli_query($conexao, $sql); // Executa a consulta

    if (!$result) {
        echo "Erro na consulta: " . mysqli_error($conexao);
        exit; // Encerra o script
    }

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header("Location: index.php");
    } else {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        header("Location: home.php");
    }
} else {
    header("Location: erro.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo</h1>
</body>
</html>
