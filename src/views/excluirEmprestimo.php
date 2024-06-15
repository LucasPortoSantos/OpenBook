<?php
    include_once('../config.php');

    // Verifique se o ID do empréstimo foi passado
    if (isset($_GET['id_emprestimo'])) {
        // Pegue o ID do empréstimo
        $id_emprestimo = $_GET['id_emprestimo'];

        // Construa a consulta SQL
        $sql = "DELETE FROM TbEmprestimos WHERE id_emprestimo = $id_emprestimo";

        // Execute a consulta
        if (mysqli_query($conexao, $sql)) {
            echo "Empréstimo excluído com sucesso.";
            header("Location: consultarEmprestimos.php?message=Empréstimo excluído com sucesso");
        } else {
            echo "Erro ao excluir empréstimo: " . mysqli_error($conexao);
        }

        // Execute a consulta
        if (mysqli_query($conexao, $sql)) {
            // Redirecione de volta para a página de consulta de leitores com uma mensagem de sucesso
            header("Location: consultarEmprestimos.php?message=Empréstimo excluído com sucesso!");
        } else {
            echo "Erro ao excluir o emprestimo: " . mysqli_error($conexao);
        }


        // Feche a conexão
        mysqli_close($conexao);
    } else {
        echo "Nenhum ID de empréstimo fornecido.";
    }
?>
