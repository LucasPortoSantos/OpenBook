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


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/consultarUsuarios.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->
    <title>Consultar Usuarios</title>
</head>
<body>
<?php
    include('navbar.php');
?>
<div class="container">
            <div class="divH1">
                <h1 class="text-dark">Consultar <span>Usuarios</span></h1>
            </div>
            <div class="divFormPesquisa">
                <form action="" method="POST">
                <div id="divGrupoPesquisar">
                <button id="btnPesquisar" value="" type="submit" name="submit">
                        <img  id="lupa" src="./lupa.png" alt="">
                    </button> 
                    <input type="text" class="inputForm" name="consulta" placeholder="Pesquisar">
                </div>

                </form>
            </div> <br>
            <table class="table table-bordered table-hover">
                <thead class="thead" style="background-color: green; color: aliceblue;">
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Cargo</th>
                        <th id="thAtalhos">Atalhos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Verifique se a consulta foi submetida
                        if (isset($_POST['submit'])) {
                            $consulta = $_POST['consulta'];

                            // Execute a consulta
                            $sql = "SELECT * FROM TbUsuarios WHERE nome_usuario LIKE '%$consulta%'";
                            $resultado = mysqli_query($conexao, $sql);
                            if (!$resultado) {
                                die('Erro na consulta: ' . mysqli_error($conexao));
                            }
                            if (mysqli_num_rows($resultado) > 0) {
                                // Exiba os resultados
                                while($row = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["usuario"] . "</td>";
                                    echo "<td>" . $row["nome_usuario"] . "</td>";
                                    echo "<td>" . $row["cpf"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["telefone"] . "</td>";
                                    echo "<td>" . $row["cargo"] . "</td>";
                                    echo "<td>
                                            <button  class='btn btn-editar'>
                                                <img class='imgBtn' src='./botao-editar.png'>
                                            </button >
                                            <button  class='btn btn-sm btn-excluir'>
                                                <img class='imgBtn' src='./botao-excluir.png' id='ImgBotaoExcluir'>
                                            </button >
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Nenhum resultado encontrado";
                            }
                        } 
                        else{
                            $sql = "SELECT * FROM TbUsuarios";
                            $resultado = mysqli_query($conexao, $sql);
                            if (!$resultado) {
                                die('Erro na consulta: ' . mysqli_error($conexao));
                            }
                            if (mysqli_num_rows($resultado) > 0) {
                                // Exiba os resultados
                                while($row = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["usuario"] . "</td>";
                                    echo "<td>" . $row["nome_usuario"] . "</td>";
                                    echo "<td>" . $row["cpf"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["telefone"] . "</td>";
                                    echo "<td>" . $row["cargo"] . "</td>";
                                    echo "<td>
                                    <a href='editarUsuario.php?id=" . $row["id"] . "' class='btn btn-editar'>
                                        <img class='imgBtn' src='./botao-editar.png'>
                                    </a>
                                    <a href='excluirUsuario.php?id=" . $row["id"] . "' class='btn btn-sm btn-excluir'>
                                        <img class='imgBtn' src='./botao-excluir.png' id='ImgBotaoExcluir'>
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
            <img src="../public/img/telaConsultarUsuarios.svg" alt="logo index" id="ilustracao">  
        </div>

        <div class="poliglota">
            <img src="../public/img/Polygon.png" alt="polygon">
        </div>

        <div class="OpenBook">
            <img src="../public/img/OpenBook2.png" alt="OpenBook">
        </div>

</body>
</html>