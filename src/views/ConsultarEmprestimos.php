<?php
    session_start();
    if(!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
        unset($_SESSION['usuario']); // destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }

    include_once('../config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/consultarEmprestimos.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->
    <title>Consultar Empréstimos</title>
</head>
<body>
<?php
    include('navbar.php');
?>
<div class="container">
    <div class="divH1">
        <h1 class="text-dark">Consultar <span>Empréstimos</span></h1>
    </div>
    <div class="divFormPesquisa">
        <form action="" method="POST">
            <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                    <img id="lupa" src="./lupa.png" alt="">
                </button> 
                <input type="text" class="inputForm" name="consulta" placeholder="Pesquisar">
            </div>
        </form>
    </div> <br>
    <table class="table table-bordered table-hover">
        <thead class="thead" style="background-color: green; color: aliceblue;">
            <tr>
                <th>ID</th>
                <th>Nome do Leitor</th>
                <th>Título do Livro</th>
                <th>Data do Empréstimo</th>
                <th>Data Prevista de Devolução</th>
                <th>Status do Empréstimo</th>
                <th id="thAtalhos">Atalhos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Verifique se a consulta foi submetida
                if (isset($_POST['submit'])) {
                    $consulta = $_POST['consulta'];

                    // Execute a consulta
                    $sql = "SELECT e.id_emprestimo, l.nome_leitor, lv.titulo, e.data_emprestimo, e.data_devolucao_prevista, e.status_emprestimo 
                            FROM TbEmprestimos e
                            JOIN TbLeitores l ON e.id_leitor = l.id_leitor
                            JOIN TbLivros lv ON e.id_livro = lv.id_livro
                            WHERE l.nome_leitor LIKE '%$consulta%' OR lv.titulo LIKE '%$consulta%'";
                    $resultado = mysqli_query($conexao, $sql);
                    if (!$resultado) {
                        die('Erro na consulta: ' . mysqli_error($conexao));
                    }
                    if (mysqli_num_rows($resultado) > 0) {
                        // Exiba os resultados
                        while($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $row["id_emprestimo"] . "</td>";
                            echo "<td>" . $row["nome_leitor"] . "</td>";
                            echo "<td>" . $row["titulo"] . "</td>";
                            echo "<td>" . $row["data_emprestimo"] . "</td>";
                            echo "<td>" . $row["data_devolucao_prevista"] . "</td>";
                            echo "<td>" . $row["status_emprestimo"] . "</td>"; 
                            echo "<td>
                                    <a href='editarEmprestimo.php?id=" . $row["id_emprestimo"] . "' class='btn btn-editar'>
                                        <img class='imgBtn' src='./botao-editar.png'>
                                    </a>
                                    <a href='excluirEmprestimo.php?id=" . $row["id_emprestimo"] . "' class='btn btn-sm btn-excluir'>
                                        <img class='imgBtn' src='./botao-excluir.png' id='ImgBotaoExcluir'>
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Nenhum resultado encontrado";
                    }
                } 
                else {
                    $sql = "SELECT e.id_emprestimo, l.nome_leitor, lv.titulo, e.data_emprestimo, e.data_devolucao_prevista, e.status_emprestimo  
                            FROM TbEmprestimos e
                            JOIN TbLeitores l ON e.id_leitor = l.id_leitor
                            JOIN TbLivros lv ON e.id_livro = lv.id_livro";

                    $resultado = mysqli_query($conexao, $sql);
                    if (!$resultado) {
                        die('Erro na consulta: ' . mysqli_error($conexao));
                    }
                    if (mysqli_num_rows($resultado) > 0) {
                        // Exiba os resultados
                        while($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $row["id_emprestimo"] . "</td>";
                            echo "<td>" . $row["nome_leitor"] . "</td>";
                            echo "<td>" . $row["titulo"] . "</td>";
                            echo "<td>" . $row["data_emprestimo"] . "</td>";
                            echo "<td>" . $row["data_devolucao_prevista"] . "</td>";
                            echo "<td>" . $row["status_emprestimo"] . "</td>";  
                            echo "<td>
                                    <a href='editarEmprestimo.php?id_emprestimo=" . $row["id_emprestimo"] . "' class='btn btn-editar'>
                                        <img class='imgBtn' src='./botao-editar.png'>
                                    </a>
                                    <a href='excluirEmprestimo.php?id_emprestimo=" . $row["id_emprestimo"] . "' class='btn btn-sm btn-excluir'>
                                        <img class='imgBtn' src='./botao-excluir.png' id_emprestimo='ImgBotaoExcluir'>
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Nenhum resultado encontrado";
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<!-- IMAGENS -->
<div class="logoindex">
    <img src="../public/img/consultarEmprestimos.svg" alt="logo index" id="ilustracao">  
</div>

<div class="poliglota">
    <img src="../public/img/Polygon.png" alt="polygon">
</div>

<div class="OpenBook">
    <img src="../public/img/OpenBook2.png" alt="OpenBook">
</div>

</body>
</html>
