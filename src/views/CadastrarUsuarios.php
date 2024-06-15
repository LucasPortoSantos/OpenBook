
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

<?php
    if (isset($_POST['submit'])) {
    include_once('../config.php');
    $usuario = mysqli_real_escape_string($conexao, $_POST['nome_usuario']);
    $nome_completo = mysqli_real_escape_string($conexao, $_POST['nome_completo']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $cargo = mysqli_real_escape_string($conexao, $_POST['tipo_perfil']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Verificar se a confirmação de senha corresponde
    $confirmar_senha = $_POST['confirmar_senha'];
    if ($senha !== $confirmar_senha) {
        echo "<p class='msgPHP'>As senhas não correspondem.</p>";
        exit;
    }

    // Criptografar a senha antes de armazená-la no banco de dados
 //   $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    
    $checkUser = "SELECT * FROM TbUsuarios WHERE usuario = '$usuario' OR email = '$email'";
    $result = mysqli_query($conexao, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        echo "<p class='msgPHP'>Usuário ou email já cadastrado.</p>";
    } else {
     
        $sql = "INSERT INTO TbUsuarios (usuario, nome_usuario, cpf, email, telefone, cargo, senha) VALUES ('$usuario', '$nome_completo', '$cpf', '$email', '$telefone', '$cargo', '$senha')";

        if (mysqli_query($conexao, $sql)) {
            header("Location: index.php");
            echo "foi;";
        } else {
            echo "Errou dnv: " . $sql . "<br>" . mysqli_error($conexao);
        }
    }

    mysqli_close($conexao);
}
?> 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/cadastrarUsuarios.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->

    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>
</head>

<body>
<?php
    include('./navbar.php');
?> 
    <div class="container">
            <form action="./CadastrarUsuarios.php" method="POST" class="form">
                <h1>Cadastrar <span>Usuários</span></h1>
                <div class="form-row">
                    <div class="left">
                        <label for="nome_completo" class="Nome">Nome Completo:</label>
                        <input type="text" id="nome_completo" name="nome_completo" required autocomplete="off">
                    
                        <label for="cpf" class="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" required autocomplete="off">
                    
                        <label for="telefone" class="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" required autocomplete="off">
                
                        <label for="email" class="email">E-mail:</label>
                        <input type="text" id="email" name="email" required autocomplete="off">
                    </div>
                    <div class="right">
                        <label for="nome_usuario" class="Usuario">Nome de Usuário:</label>
                        <input type="text" id="nome_usuario" name="nome_usuario" required autocomplete="off">

                        <label for="senha" class="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required autocomplete="off">

                    
                        <label for="confirmar_senha" class="ConfirmarSenha">Confirmar Senha:</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required autocomplete="off">
                    
                        <label for="tipo_perfil"  class="perfil">Tipo de Perfil:</label> <br>
                            <select id="tipo_perfil" name="tipo_perfil">
                                <option value="Administrador">Administrador</option>
                                <option value="Bibliotecário">Bibliotecário</option>
                            </select>
                    </div>
                </div>
                <div class="centered-button">
                    <input id="btnLogin" class="button" name="submit" type="submit"></input>
                </div>
            </form>

    </div>
    <div class="img">
        <img src="../public/img/cadastroDeUsuarios.svg">
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
