<!-- SESSÃO PHP -->
 <?php
    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }
 
    include_once('../config.php');
?>  
<!-- NAVBAR PHP -->
  <?php
    include('./navbar.php');
?>  
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/Controle.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">    <!-- fonte Poppins -->
    <title>Controle Leitores</title>
</head>
<body>

    <!-- BOTÕES -->
    <div class="titulo">
        <h1>Controle de <span>Leitores<span></h1>
    </div>
<div class="container">
    <a class="button-group" href="./CadastrarLeitores.php">
        <button class="btn-green"><img src="../public/img/botao-adicionar.png" alt="Cadastrar"></button>
        <button class="btn-white">Cadastrar</button>
    </a>

    <a class="button-group"  href="./ConsultarLeitores.php">
        <button class="btn-green"><img src="../public/img/procurar 1.png" alt="Livros"></button>
        <button class="btn-white">Consultar</button>
    </a>
    

      <!-- IMAGENS -->
<div class="logoindex">
    <img src="../public/img/controleDeLeitores.svg" alt="logo index" id="ilustracao">  
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

