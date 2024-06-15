<?php
    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }
 
    include_once('../config.php');

    // Obtenha o ID do usuário da URL
    $id = $_GET['id'];

    // Exclua o usuário
    $sql = "DELETE FROM TbUsuarios WHERE id = '$id'";

    if (mysqli_query($conexao, $sql)) {
        header("Location: consultarUsuarios.php");
    } else {
        echo "Erro ao excluir registro: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
?>
