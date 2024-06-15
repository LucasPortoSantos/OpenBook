<?php
    // Verifique se o ID do leitor foi passado
    if (isset($_GET['id_leitor'])) {
        $id_leitor = $_GET['id_leitor'];

        // Conecte-se ao banco de dados
        include_once('../config.php');

        // Crie a consulta SQL para excluir o leitor
        $sql = "DELETE FROM TbLeitores WHERE id_leitor = $id_leitor";

        // Execute a consulta
        if (mysqli_query($conexao, $sql)) {
            // Redirecione de volta para a página de consulta de leitores com uma mensagem de sucesso
            header("Location: consultarLeitores.php?message=Leitor excluído com sucesso!");
        } else {
            echo "Erro ao excluir leitor: " . mysqli_error($conexao);
        }

        // Feche a conexão com o banco de dados
        mysqli_close($conexao);
    } else {
        echo "Nenhum ID de leitor fornecido para excluir";
    }
?>
