<?php
include('conexao.php');

$sql_alunos = "SELECT * FROM cadastros_alunos";
$query_alunos = $mysqli->query($sql_alunos) or die($mysqli->error);
$num_alunos = $query_alunos->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
</head>
<body>
    <h1>Lista de Alunos</h1>
    <p>Estes são os alunos cadastrados no seu sistema:</p>
    <table border="1" cellpading="5">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>E-mail</th>
            <th>Data de Nascimento</th>
            <th>Endereço</th>
            <th>Telenfone</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if($num_alunos == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum aluno foi cadastrado</td>
                </tr>
            <?php 
            }else { 
                while($cadastros_alunos = $query_alunos->fetch_assoc()) {
                
            ?>
                <tr>
                    <td><?php echo $cadastros_alunos['id']; ?></td>
                    <td><?php echo $cadastros_alunos['nome']; ?></td>
                    <td><?php echo $cadastros_alunos['sobrenome']; ?></td>
                    <td><?php echo $cadastros_alunos['email']; ?></td>
                    <td><?php echo $cadastros_alunos['data_nascimento']; ?></td>
                    <td><?php echo $cadastros_alunos['endereco']; ?></td>
                    <td><?php echo $cadastros_alunos['telefone']; ?></td>
                    <td><?php echo $cadastros_alunos['data_cadastro']; ?></td>
                    <td>
                        <a href="">Editar</a>
                        <a href="">Deletar</a>
                    </td>
                </tr>
            <?php
                } 
            } ?>
        </tbody>
    </table>
</body>
</html>