<?php
    session_start();
    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
        header("Location: index.php");
        exit;
    }
  
    include_once('../config.php');

    // Verifique se o ID do leitor foi passado
    if (isset($_GET['id_leitor'])) {
        $id_leitor = $_GET['id_leitor'];

        // Busque os dados do leitor
        $sql = "SELECT * FROM TbLeitores WHERE id_leitor = '$id_leitor'";
        $resultado = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($resultado);

        // Atualize os dados do leitor quando o formulário for enviado
        if (isset($_POST['submit'])) {
            $nome_leitor = mysqli_real_escape_string($conexao, $_POST['nome_leitor']);
            $cpf_leitor = mysqli_real_escape_string($conexao, $_POST['cpf_leitor']);
            $email_leitor = mysqli_real_escape_string($conexao, $_POST['email_leitor']);
            $telefone_leitor = mysqli_real_escape_string($conexao, $_POST['telefone_leitor']);
            $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);


            $sql = "UPDATE TbLeitores SET nome_leitor = '$nome_leitor', cpf_leitor = '$cpf_leitor', email_leitor = '$email_leitor', telefone_leitor = '$telefone_leitor', data_nascimento = '$data_nascimento' WHERE id_leitor = '$id_leitor'";

            if (mysqli_query($conexao, $sql)) {
                header("Location: consultarLeitores.php");
                exit;
            } else {
                echo "Erro ao atualizar o leitor: " . mysqli_error($conexao);
            }
        }
    } else {
        echo "Nenhum ID de leitor fornecido para editar";
        exit;
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
    <title>Editar Leitor</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cpf_leitor').mask('000.000.000-00', {reverse: true});
            $('#telefone_leitor').mask('(00) 00000-0000');
            $('#data_nascimento').mask('00/00/0000');
        });
    </script>
</head>
<body>
<?php
    include('navbar.php');
?> 
    <div class="container">
        <form action="./editarLeitor.php?id_leitor=<?php echo $id_leitor; ?>" method="POST" class="form">
            <h1>Editar <span>Leitor</span></h1>
            <div class="form-row">
                <div class="left">

                    <label for="nome_leitor" class="cpf">Nome:</label>
                    <input type="text" id="nome_leitor" name="nome_leitor" required autocomplete="off" value="<?php echo $row['nome_leitor']; ?>">
                    
                    <label for="cpf_leitor" class="telefone">CPF :</label>
                    <input type="text" id="cpf_leitor" name="cpf_leitor" required autocomplete="off" value="<?php echo $row['cpf_leitor']; ?>">

                    <label for="telefone_leitor" class="Usuario">Telefone :</label>
                    <input type="text" id="telefone_leitor" name="telefone_leitor" required autocomplete="off" value="<?php echo $row['telefone_leitor']; ?>">
                

                </div>
                <div class="right">
                    <label for="email_leitor" class="email">Email:</label>
                    <input type="text" id="email_leitor" name="email_leitor" required autocomplete="off" value="<?php echo $row['email_leitor']; ?>">

                    <label for="data_cadastro" class="senha">Data Cadastro:</label>
                    <input type="text" id="data_cadastro" name="data_cadastro" value="<?php echo $row['data_cadastro']; ?>" readonly>
                    
                    <label for="data_nascimento" class="ConfirmarSenha">Data de Nascimento :</label>
                    <input type="text" id="data_nascimento" name="data_nascimento" required autocomplete="off" value="<?php echo $row['data_nascimento']; ?>">
                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" class="button" name="submit" type="submit" value="Atualizar"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/editarAutor.svg">
    </div>
</body>
</html>
