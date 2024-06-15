<?php
    session_start();
    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
        header("Location: index.php");
        exit;
    }
  
    include_once('../config.php');

    if (isset($_POST['submit'])) {
        include_once('../config.php');
        
        // Evitar SQL Injection
        $nome_autor = mysqli_real_escape_string($conexao, $_POST['nome_autor']);

        // Construção correta da consulta SQL
        $sql = "INSERT INTO TbAutores (nome_autor) VALUES ('$nome_autor')";

        if (mysqli_query($conexao, $sql)) {
            $message = "Autor cadastrado com sucesso!";
            header("Location: home.php?message=".urlencode($message));
            exit;
        } else {
            $error = "Erro ao cadastrar autor: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/CadastrarAutoEdito.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->
    <title>Cadastrar Autores</title>
</head>
<body>
<?php
    include('./navbar.php');
?> 
    <div class="container">
        <form action="" method="POST" class="form">
            <h1>Cadastrar <span>Autores</span></h1>
            <?php if(isset($message)): ?>
                <p class="success-message"><?php echo $message; ?></p>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-row">
                <div class="left">
                    <label for="nome_autor" class="Nome">Nome do Autor:</label>
                    <input type="text" id="nome_autor" name="nome_autor" required autocomplete="off">
                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" class="button" name="submit" type="submit" value="Cadastrar"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/adicionarAutor.svg">
    </div>
</body>
</html>
