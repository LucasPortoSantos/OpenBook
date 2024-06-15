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
        echo "As senhas não correspondem.";
        exit;
    }

    // Criptografar a senha antes de armazená-la no banco de dados
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o usuário ou email já existe
    $checkUser = "SELECT * FROM TbUsuarios WHERE usuario = '$usuario' OR email = '$email'";
    $result = mysqli_query($conexao, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        echo "Usuário ou email já cadastrado.";
    } else {
        // Construção correta da consulta SQL
        $sql = "INSERT INTO TbUsuarios (usuario, nome_usuario, cpf, email, telefone, cargo, senha) VALUES ('$usuario', '$nome_completo', '$cpf', '$email', '$telefone', '$cargo', '$senhaHash')";

        if (mysqli_query($conexao, $sql)) {
            header("Location: login.php");
            echo "foi;";
        } else {
            echo "Errou dnv: " . $sql . "<br>" . mysqli_error($conexao);
        }
    }

    mysqli_close($conexao);
}
?>
