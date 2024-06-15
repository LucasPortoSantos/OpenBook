<?php
    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }
 
    include_once('../config.php');

    
    $id_editora = $_GET['id_editora'];

   
    $sql = "DELETE FROM TbEditoras WHERE id_editora = '$id_editora'";

    if (mysqli_query($conexao, $sql)) {
        header("Location: consultarEditoras.php");
    } else {
        echo "Erro ao excluir registro: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
?>
