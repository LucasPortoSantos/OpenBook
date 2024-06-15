<?php
    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }
 
    include_once('../config.php');
    

    $usuario = $_SESSION['usuario'];

    $sql = "SELECT * FROM tbusuarios WHERE usuario = '$usuario'";
    $result = $conexao->query($sql);
    $nome = mysqli_fetch_assoc($result)["nome_usuario"];
    $result2 = $conexao->query($sql);
    $cargo = mysqli_fetch_assoc($result2)["cargo"];

    if(isset($_SESSION['livro_cadastrado']) && $_SESSION['livro_cadastrado'] === true) {
        echo "<p>Livro cadastrado</p>";

      
        unset($_SESSION['livro_cadastrado']);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/home.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->

    <title>Home</title>
</head>
<body>
    <!-- Barra de navegação -->
    <header>
        <?php
            include_once("./navbarHome.php");
        ?>
    </header>
    <!-- BOTÕES -->
    <div class = "usuario">
    <div class="usuarioElementos">
        <?php 
        echo "<h3>Olá, $nome!</h3>";
        echo " <p>Seu cargo é <span>$cargo.</span></p>"
        ?> 
    </div>
</div>
<div class="container">
    <a href="./ControleDeLivros.php" class="button-group">
        <button class="btn-green"><img src="../public/img/Livros3.png" alt="Livros"></button>
        <button class="btn-white">Livros</button>
    </a>
    <a href="./ControleDeAutores.php" class="button-group">
        <button class="btn-green"><img src="../public/img/autores.png" alt="Autores"></button>
        <button class="btn-white">Autores</button>
    </a>
    <a href="./ControleDeEditoras.php" class="button-group">
        <button class="btn-green"><img src="../public/img/Editoras.png" alt="Editoras"></button>
        <button class="btn-white">Editoras</button>
    </a>
    <?php
    // Verifique se o usuário é um administrador
    if ($cargo == 'Administrador') {
    ?>
    <a href="./ControleDeUsuarios.php" class="button-group">
        <button class="btn-green"><img src="../public/img/Usuarios.png" alt="Usuários"></button>
        <button class="btn-white">Usuários</button>
    </a>
    <?php
    }  
    ?>
    <a href="./ControleDeLeitores.php" class="button-group">
        <button class="btn-green"><img src="../public/img/Leitores.png" alt="Leitores" ></button>
        <button class="btn-white">Leitores</button>
    </a>
    <a href="./ControleDeEmprestimos.php" class="button-group">
        <button class="btn-green"><img src="../public/img/pedir-emprestado.png" alt="Emprestimos"></button>
        <button class="btn-white">Emprestimos</button>
    </a>

      <!-- IMAGENS -->
<div class="logoindex">
    <img src="../public/img/telaInicial.svg" alt="logo index" id="ilustracao">  
</div>

<div class="poliglota">
    <img src="../public/img/Polygon.png" alt="polygon">
</div>

<div class="OpenBook">
    <img src="../public/img/OpenBook2.png" alt="OpenBook">
</div>

</div>
</body>
</html>
