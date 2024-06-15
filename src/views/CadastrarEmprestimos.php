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
?>

<?php
    if (isset($_POST['submit'])) {
        include_once('../config.php');

        $id_leitor = mysqli_real_escape_string($conexao, $_POST['id_leitor']);
        $id_livro = mysqli_real_escape_string($conexao, $_POST['id_livro']);
        $data_devolucao_real = mysqli_real_escape_string($conexao, $_POST['data_devolucao_real']);
         $status_emprestimo = mysqli_real_escape_string($conexao, $_POST['status_emprestimo']);


        // Construção correta da consulta SQL
        $sql = "INSERT INTO TbEmprestimos (id_leitor, id_livro, data_emprestimo, data_devolucao_prevista, status_emprestimo) VALUES ('$id_leitor', '$id_livro', '$data_emprestimo', '$data_devolucao_prevista', '$status_emprestimo')";
        if (mysqli_query($conexao, $sql)) {
            header("Location: consultarEmprestimos.php?message=Emprestimo cadastrado com sucesso");
        } else {
            echo "Erro ao cadastrar empréstimo: " . $sql . "<br>" . mysqli_error($conexao);
        }

        mysqli_close($conexao);
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

    <title>Cadastrar Empréstimos</title>
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
        <form action="./CadastrarEmprestimos.php" method="POST" class="form">
            <h1>Cadastrar <span>Empréstimos</span></h1>
            <div class="form-row">
                <div class="left">
                    
                    <label for="ID Leitor" class="cpf">ID do leitor:</label>
                    <input type="text" id="id_leitor" name="id_leitor" required autocomplete="off">
                    
                    <label for="ID Livro" class="telefone">ID do livro:</label>
                    <input type="text" id="id_livro" name="id_livro" required autocomplete="off">
                
                    <label for="data empréstimo" class="email">Data do empréstimo:</label>
                    <input type="text" id="data_emprestimo" name="data_emprestimo" value="<?php echo $data_emprestimo; ?>" readonly>
                </div>
                <div class="right">
                    <label for="data devolução prevista" class="Usuario">Data Devolução Prevista:</label>
                    <input type="text" id="data_devolucao_prevista" name="data_devolucao_prevista" value="<?php echo $data_devolucao_prevista; ?>" readonly>

                    <label for="data devolução real" class="senha">Data Devolução Real:</label>
                    <input type="text" id="data_devolucao_real" name="data_devolucao_real" autocomplete="off">
                    <label for="status_emprestimo" class="perfil">Status do empréstimo</label> <br>
                    <select id="status_emprestimo" name="status_emprestimo" required>
                            <option value="Pendente">Pendente</option>
                            <option value="Atrasado">Atrasado</option>
                            <option value="Concluído">Concluído</option>
        
                        </select>

                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" class="button" name="submit" value="Cadastrar"  type="submit"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/CadasrarEmprestimo.svg">
    </div>
</body>
</html>
