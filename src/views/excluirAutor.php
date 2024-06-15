<?php
session_start();
if(!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header("Location: index.php");
    exit;
}

include_once('../config.php');

$id_autor = mysqli_real_escape_string($conexao, $_GET['id_autor']);

$sql = "DELETE FROM TbAutores WHERE id_autor = '$id_autor'";


if (mysqli_query($conexao, $sql)) {
    header("Location: consultarAutores.php");
    exit;
} else {
    echo "Erro ao excluir o autor: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
