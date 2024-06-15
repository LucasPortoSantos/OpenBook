<?php
    session_start();
    if (!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header("Location: index.php");
        exit;
    }

    include_once('../config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/consultarLivros.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Consultar Livros</title>
</head>
<body>
<?php
    include('navbar.php');
?>
<div class="container">
    <div class="divH1">
        <h1 class="text-dark">Consultar <span>Livros</span></h1>
    </div>
    <div class="divFormPesquisa">
        <form action="" method="POST">
            <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                    <img id="lupa" src="./lupa.png" alt="">
                </button> 
                <input type="text" class="inputForm" name="consulta" placeholder="Título do Livro">
            </div>
        </form> 

        <form action="" method="POST">
            <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                    <img id="lupa" src="./lupa.png" alt="">
                </button> 
                <input type="text" class="inputForm" name="consultaAutor" placeholder="Autor">
            </div>
        </form>
        <form action="" method="POST">
            <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                    <img id="lupa" src="./lupa.png" alt="">
                </button> 
                <input type="text" class="inputForm" name="consultaAnoPublicacao" placeholder="Ano de publicação">
            </div>
        </form>
        <form action="" method="POST">
            <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                    <img id="lupa" src="./lupa.png" alt="">
                </button> 
                <input type="text" class="inputForm" name="consultaEditora" placeholder="Editora">
            </div>
        </form>
    </div> 
    <table class="table table-bordered table-hover">
        <thead class="thead" style="background-color: green; color: aliceblue;">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Editora</th>
                <th>Ano de Publicação</th>
                <th>Quantidade Disponível</th>
                <th id="thAtalhos">Atalhos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : '';
                $consultaAutor = isset($_POST['consultaAutor']) ? $_POST['consultaAutor'] : '';
                $consultaAnoPublicacao = isset($_POST['consultaAnoPublicacao']) ? $_POST['consultaAnoPublicacao'] : '';
                $consultaEditora = isset($_POST['consultaEditora']) ? $_POST['consultaEditora'] : '';

             
                $sql = "SELECT TbLivros.id_livro, TbLivros.titulo, TbAutores.nome_autor, TbLivros.genero, TbEditoras.nome_editora, TbLivros.ano_publicacao, TbLivros.quantidade_disponivel 
                        FROM TbLivros 
                        INNER JOIN TbAutores ON TbLivros.autores = TbAutores.id_autor 
                        INNER JOIN TbEditoras ON TbLivros.editora = TbEditoras.id_editora
                        WHERE 1=1";

                if (!empty($consulta)) {
                    $sql .= " AND TbLivros.titulo LIKE '%$consulta%'";
                }
                if (!empty($consultaAutor)) {
                    $sql .= " AND TbAutores.nome_autor LIKE '%$consultaAutor%'";
                }
                if (!empty($consultaAnoPublicacao)) {
                    $sql .= " AND TbLivros.ano_publicacao LIKE '%$consultaAnoPublicacao%'";
                }
                if (!empty($consultaEditora)) {
                    $sql .= " AND TbEditoras.nome_editora LIKE '%$consultaEditora%'";
                }

                $resultado = mysqli_query($conexao, $sql);
                if (!$resultado) {
                    die('Erro na consulta: ' . mysqli_error($conexao));
                }
                if (mysqli_num_rows($resultado) > 0) {
                    // Exiba os resultados
                    while($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_livro"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td>" . $row["nome_autor"] . "</td>";
                        echo "<td>" . $row["genero"] . "</td>";
                        echo "<td>" . $row["nome_editora"] . "</td>";
                        echo "<td>" . $row["ano_publicacao"] . "</td>";
                        echo "<td>" . $row["quantidade_disponivel"] . "</td>";
                        echo "<td>
                                <a href='editarLivros.php?id_livro=" . $row["id_livro"] . "' class='btn btn-editar'>
                                    <img class='imgBtn' src='./botao-editar.png'>
                                </a>
                                <a href='excluirLivro.php?id_livro=" . $row["id_livro"] . "' class='btn btn-sm btn-excluir'>
                                    <img class='imgBtn' src='./botao-excluir.png' id='ImgBotaoExcluir'>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align: center;'>Registro não encontrado</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<!-- IMAGENS -->
<div class="logoindex">
    <img src="../public/img/consultarLivros.svg" alt="logo index" id="ilustracao">  
</div>

<div class="poliglota">
    <img src="../public/img/Polygon.png" alt="polygon">
</div>

<div class="OpenBook">
    <img src="../public/img/OpenBook2.png" alt="OpenBook">
</div>

</body>
</html>
