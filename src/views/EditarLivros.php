<?php
include_once('../config.php');
session_start();

if (!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header("Location: index.php");
    exit;
}

// Obtenha o ID do livro da URL
$id_livro = $_GET['id_livro'];

// Busque os dados do livro
$sql = "SELECT * FROM TbLivros WHERE id_livro = '$id_livro'";
$resultado = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($resultado);

// Busca os autores e editoras do banco de dados
$sql_autores = "SELECT * FROM TbAutores";
$result_autores = mysqli_query($conexao, $sql_autores);
$autores = mysqli_fetch_all($result_autores, MYSQLI_ASSOC);

$sql_editoras = "SELECT * FROM TbEditoras";
$result_editoras = mysqli_query($conexao, $sql_editoras);
$editoras = mysqli_fetch_all($result_editoras, MYSQLI_ASSOC);

// Atualize os dados do livro quando o formulário for enviado
if (isset($_POST['submit'])) {
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
    $autores = mysqli_real_escape_string($conexao, $_POST['autores']);
    $genero = mysqli_real_escape_string($conexao, $_POST['genero']);
    $editora = mysqli_real_escape_string($conexao, $_POST['editora']);
    $ano_publicacao = mysqli_real_escape_string($conexao, $_POST['ano_publicacao']);
    $quantidade_disponivel = mysqli_real_escape_string($conexao, $_POST['quantidade_disponivel']);

    $sql = "UPDATE TbLivros SET 
                titulo = '$titulo', 
                autores = '$autores', 
                genero = '$genero', 
                editora = '$editora', 
                ano_publicacao = '$ano_publicacao', 
                quantidade_disponivel = '$quantidade_disponivel' 
            WHERE id_livro = '$id_livro'";

    if (mysqli_query($conexao, $sql)) {
        header("Location: consultarLivros.php");
        exit;
    } else {
        echo "Erro ao atualizar o livro: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/CadastrarLiLeEmpre.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <title>Editar Livro</title>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <form action="editarLivros.php?id_livro=<?php echo $id_livro; ?>" method="POST" class="form">
        <h1>Editar <span>Livro</span></h1>
        <div class="form-row">
            <div class="left">
                <label for="titulo" class="Nome">Título:</label>
                <input type="text" id="titulo" name="titulo" required autocomplete="off" value="<?php echo $row['titulo']; ?>">

                <label for="autores"  class="autores">Autor:</label>
                <select id="autores" name="autores">
                    <?php foreach ($autores as $autor): ?>
                        <option value="<?= $autor['id_autor'] ?>" <?= $row['autores'] == $autor['id_autor'] ? 'selected' : '' ?>><?= $autor['nome_autor'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="editora"  class="editora">Editora:</label> 
                <select id="editora" name="editora">
                    <?php foreach ($editoras as $editora): ?>
                        <option value="<?= $editora['id_editora'] ?>" <?= $row['editora'] == $editora['id_editora'] ? 'selected' : '' ?>><?= $editora['nome_editora'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="right">
                <label for="genero" class="email">Gênero:</label>
                <input type="text" id="genero" name="genero" required autocomplete="off" value="<?php echo $row['genero']; ?>">

                <label for="ano_publicacao" class="senha">Ano de Publicação:</label>
                <input type="text" id="ano_publicacao" name="ano_publicacao" required autocomplete="off" value="<?php echo $row['ano_publicacao']; ?>">

                <label for="quantidade_disponivel" class="ConfirmarSenha">Quantidade Disponível:</label>
                <input type="text" id="quantidade_disponivel" name="quantidade_disponivel" required autocomplete="off" value="<?php echo $row['quantidade_disponivel']; ?>">
            </div>
        </div>
        <div class="centered-button">
            <input id="btnLogin" class="button" name="submit" type="submit" value="Atualizar"></input>
        </div>
    </form>
</div>
<div class="img">
    <img src="../public/img/editarLivros.svg">
</div>
</body>
</html>
