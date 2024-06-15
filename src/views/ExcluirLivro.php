<?php
session_start();
if(!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header("Location: index.php");
    exit;
}

include_once('../config.php');

$id_livro = mysqli_real_escape_string($conexao, $_GET['id_livro']);

$sql = "DELETE FROM TbLivros WHERE id_livro = '$id_livro'";

if (mysqli_query($conexao, $sql)) {
    header("Location: consultarLivros.php");
    exit;
} else {
    echo "Erro ao excluir o livro: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
