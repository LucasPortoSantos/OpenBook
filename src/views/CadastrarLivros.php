<?php
    session_start();
    include_once('../config.php');

    if(!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
        unset($_SESSION['usuario']); 
        unset($_SESSION['senha']);
        header("Location: index.php");
        exit; 
    }

    // Busca os autores e editoras do banco de dados
    $sql_autores = "SELECT * FROM TbAutores";
    $result_autores = mysqli_query($conexao, $sql_autores);
    $autores = mysqli_fetch_all($result_autores, MYSQLI_ASSOC);

    $sql_editoras = "SELECT * FROM TbEditoras";
    $result_editoras = mysqli_query($conexao, $sql_editoras);
    $editoras = mysqli_fetch_all($result_editoras, MYSQLI_ASSOC);

    if (isset($_POST['submit'])) {
        $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
        $autores = mysqli_real_escape_string($conexao, $_POST['autores']);
        $genero = mysqli_real_escape_string($conexao, $_POST['genero']);
        $editora = mysqli_real_escape_string($conexao, $_POST['editora']);
        $ano_publicacao = mysqli_real_escape_string($conexao, $_POST['ano_publicacao']);
        $quantidade_disponivel = mysqli_real_escape_string($conexao, $_POST['quantidade_disponivel']);

        $sql = "INSERT INTO TbLivros (titulo, autores, genero, editora, ano_publicacao, quantidade_disponivel) 
                VALUES ('$titulo', '$autores', '$genero', '$editora', '$ano_publicacao', '$quantidade_disponivel')";

        if (mysqli_query($conexao, $sql)) {
            $_SESSION['livro_cadastrado'] = true; // Define uma variável de sessão para indicar que o livro foi cadastrado
            header("Location: home.php");
            exit; // Encerra o script após o redirecionamento
        } else {
            echo "Erro ao cadastrar o livro: " . mysqli_error($conexao);
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
    <title>Cadastrar Livros</title>
</head>
<body>
<?php
    include('navbar.php');
?> 
    <div class="container">
        <form action="./CadastrarLivros.php" method="POST" class="form">
            <h1>Cadastrar <span>Livros</span></h1>
            <div class="form-row">
                <div class="left">
                    
                    <label for="titulo" class="cpf">Título:</label>
                    <input type="text" id="titulo" name="titulo" required autocomplete="off">
 
                    <label for="autores"  class="autores">Autor:</label>
                            <select id="autores" name="autores">
                                <?php foreach ($autores as $autor): ?>
                                    <option value="<?= $autor['id_autor'] ?>"><?= $autor['nome_autor'] ?></option>
                                <?php endforeach; ?>
                            </select>

                    <label for="editora"  class="editora">Editora:</label> 
                    <select id="editora" name="editora">
                        <?php foreach ($editoras as $editora): ?>
                            <option value="<?= $editora['id_editora'] ?>"><?= $editora['nome_editora'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="right">
                    
                    <label for="genero" class="email">Gênero:</label>
                    <input type="text" id="genero" name="genero" required autocomplete="off">

                    <label for="ano_publicacao" class="senha">Ano de Publicação:</label>
                    <input type="text" id="ano_publicacao" name="ano_publicacao" required autocomplete="off">
                    
                    <label for="quantidade_disponivel" class="ConfirmarSenha">Quantidade Disponível:</label>
                    <input type="text" id="quantidade_disponivel" name="quantidade_disponivel" required autocomplete="off">
                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" value="Cadastrar" class="button" name="submit" type="submit"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/cadastrarLivros.svg">
    </div>
</body>
</html>
