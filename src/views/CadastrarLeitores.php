<?php
    // Definir o fuso horário para São Paulo
    date_default_timezone_set('America/Sao_Paulo');

    // Pegar a data atual do sistema
    $data_cadastro = date('d/m/Y');

    session_start();
    if(!isset($_SESSION['usuario']) == true and !isset($_SESSION['senha']) == true)
    {
        unset($_SESSION['usuario']); //destroi qualquer variável que tenha esse valor
        unset($_SESSION['senha']);
        header("Location: index.php");
    }
 
    include_once('../config.php');
?> 
<?php
    if (isset($_POST['submit'])) {
    $nome_leitor = mysqli_real_escape_string($conexao, $_POST['nome_leitor']);
    $cpf_leitor = mysqli_real_escape_string($conexao, $_POST['cpf_leitor']);
    $email_leitor = mysqli_real_escape_string($conexao, $_POST['email_leitor']);
    $telefone_leitor = mysqli_real_escape_string($conexao, $_POST['telefone_leitor']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);

    $sql = "INSERT INTO TbLeitores (nome_leitor, cpf_leitor, email_leitor, telefone_leitor, data_cadastro, data_nascimento) VALUES ('$nome_leitor', '$cpf_leitor', '$email_leitor', '$telefone_leitor', '$data_cadastro', '$data_nascimento')";

    if (mysqli_query($conexao, $sql)) {
        $message = "Leitor cadastrado com sucesso!";
        header("Location: ConsultarLeitores.php?message=".urlencode($message));
        exit;
    } else {
        $error = "Erro ao cadastrar leitor: " . mysqli_error($conexao);
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
    <title>Cadastrar Leitores</title>
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
        <form action="" method="POST" class="form">
            <h1>Cadastrar <span>Leitores</span></h1>
            <?php if(isset($message)): ?>
                <p class="success-message"><?php echo $message; ?></p>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-row">
                <div class="left">

                    <label for="nome_leitor" class="cpf">Nome:</label>
                    <input type="text" id="nome_leitor" name="nome_leitor" required autocomplete="off">
                    
                    <label for="cpf_leitor" class="telefone">CPF :</label>
                    <input type="text" id="cpf_leitor" name="cpf_leitor" required autocomplete="off">

                    <label for="telefone_leitor" class="Usuario">Telefone :</label>
                    <input type="text" id="telefone_leitor" name="telefone_leitor" required autocomplete="off">
                

                </div>
                <div class="right">
                    <label for="email_leitor" class="email">Email:</label>
                    <input type="text" id="email_leitor" name="email_leitor" required autocomplete="off">


                    <label for="data_cadastro" class="senha">Data Cadastro:</label>
                    <input type="text" id="data_cadastro" name="data_cadastro" value="<?php echo $data_cadastro; ?>" readonly>
                    
                    <label for="data_nascimento" class="ConfirmarSenha">Data de Nascimento :</label>
                    <input type="text" id="data_nascimento" name="data_nascimento" required autocomplete="off">
                </div>
            </div>
            <div class="centered-button">
                <input id="btnLogin" class="button" name="submit" type="submit" value="Cadastrar"></input>
            </div>
        </form>
    </div>
    <div class="img">
        <img src="../public/img/adicionarLeitores.svg">
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
