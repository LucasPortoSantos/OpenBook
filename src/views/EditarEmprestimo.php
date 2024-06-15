<?php
    // Definir o fuso horário para São Paulo
    date_default_timezone_set('America/Sao_Paulo');

    // Pegar a data atual do sistema
    $data_emprestimo = date('Y-m-d');
    $data_devolucao_prevista = date('Y-m-d', strtotime('+10 days'));
    

    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: home.php");
    }
 
    include_once('../config.php');
    // Verifique se a variável $conexao está definida
    if (!isset($conexao)) {
        die("Erro: A variável de conexão não está definida.");
    }
?>
<!-- NAVBAR PHP -->

<!-- EDIÇÃO PHP -->
<?php
    $id_emprestimo = $_GET['id_emprestimo'];

    // Busque os dados do empréstimo
    $sql = "SELECT * FROM TbEmprestimos WHERE id_emprestimo = '$id_emprestimo'";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($resultado);

    // Reformatar a data do empréstimo para o formato dd/mm/yyyy
    $data_emprestimo = date('d/m/Y', strtotime($row['data_emprestimo'])); 

    // Atualize os dados do empréstimo quando o formulário for enviado
    if (isset($_POST['submit'])) {
        $id_leitor = mysqli_real_escape_string($conexao, $_POST['id_leitor']);
        $id_livro = mysqli_real_escape_string($conexao, $_POST['id_livro']);
        $data_devolucao_real = mysqli_real_escape_string($conexao, $_POST['data_devolucao_real']);
        $status_emprestimo = mysqli_real_escape_string($conexao, $_POST['status_emprestimo']);


        $sql = "UPDATE TbEmprestimos SET id_leitor = '$id_leitor', id_livro = '$id_livro', data_devolucao_real = '$data_devolucao_real', status_emprestimo = '$status_emprestimo' 
        WHERE id_emprestimo = '$id_emprestimo'";
        $resultado = mysqli_query($conexao, $sql);
        header("Location: ConsultarEmprestimos.php?message=Emprestimo atualizado com sucesso");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/CadastrarLiLeEmpre.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->

    <title>Editar Empréstimos</title>
     <style>
        #status_emprestimo {
            padding: 5px;
            margin-bottom: 3em;
            border: 1px solid #4CAF50;
            border-radius: 4px;
            outline: none;
            font-family: "Poppins";
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</head>
<body>
    <?php
    include('./navbar.php');
?>
    <div class="container">
        <form action="./editarEmprestimo.php?id_emprestimo=<?php echo $id_emprestimo; ?>" method="POST" class="form">
            <h1>Editar <span>Empréstimos</span></h1>
            <div class="form-row">
                <div class="left">
                    
                    <label for="ID Leitor" class="cpf">ID do leitor:</label>
                    <input type="text" id="id_leitor" name="id_leitor" required autocomplete="off" value="<?php echo $row['id_leitor']; ?>">
                    
                    <label for="ID Livro" class="telefone">ID do livro:</label>
                    <input type="text" id="id_livro" name="id_livro" required autocomplete="off" value="<?php echo $row['id_livro']; ?>">
                
                    <label for="data empréstimo" class="email">Data do empréstimo:</label>
                    <input type="text" id="data_emprestimo" name="data_emprestimo" value="<?php echo $row['data_emprestimo']; ?>" readonly>
                </div>
                <div class="right">
                    <label for="data devolução prevista" class="Usuario">Data de devolução prevista:</label>
                    <input type="text" id="data_devolucao_prevista" name="data_devolucao_prevista" value="<?php echo $row['data_devolucao_prevista']; ?>" readonly>

                    <label for="data devolução real" class="senha">Data de devolução real:</label>
                    <input type="text" id="data_devolucao_real" name="data_devolucao_real" autocomplete="off" value="<?php echo $row['data_devolucao_real']; ?>">

                    <label for="status_emprestimo"  class="perfil">Status do empréstimo</label> <br>
                            <select id="status_emprestimo" name="status_emprestimo">
                                <option value="Pendente"<?php if ($row['status_emprestimo'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                <option value="Concluído"<?php if ($row['status_emprestimo'] == 'Concluído') echo 'selected'; ?>>Concluído</option>
                                <option value="Atrasado"<?php if ($row['status_emprestimo'] == 'Atrasado') echo 'selected'; ?>>Atrasado</option>
                            </select>


                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" class="button" name="submit" type="submit" value="Atualizar"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/TelaEditarEmprestimo.svg">
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
