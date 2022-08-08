<?php

function limpar_texto($str) { 
    return preg_replace("/[^0-9]/", "", $str);
}

if(count($_POST) > 0) {

    include('conexao.php');

    $erro = false;
    $nome = $_POST ['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    if(empty($nome)) {
        $erro = "Preencha o nome";
    }
    if(empty($sobrenome)) {
        $erro = "Preencha o sobrenome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o email";
    }
    if(empty($endereco)) {
        $erro = "Preencha o Endereço";
    }
    if(empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }
    if(empty($data_nascimento)) {
        $erro = "Preencha a data de nascimento";
    }
    
    if($erro) {
        echo "<p><b>Erro: $erro</b></p>";
    } else {
        $sql_code = "INSERT INTO cadastros_alunos (nome, sobrenome, email, data_nascimento, endereco, telefone, data_cadastro) VALUES ('$nome', '$sobrenome', '$email', '$data_nascimento', '$endereco', '$telefone', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die ($mysqli->error);
        if($deu_certo) {
            echo "<p><b>Aluno cadastrado com sucesso!</b></p>";
            unset($_POST);
        }


        
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Alunos</title>
</head>
<body>
    <a href="alunos.php">Voltar para a lista</a>
    <form method="POST" action="">
        <p>    
            <label>Nome:</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" name="nome" type="text">
        </p>
        <p>
            <label>Sobrenome:</label>
            <input value="<?php if(isset($_POST['sobrenome'])) echo $_POST['sobrenome'];?>" name="sobrenome" type="text">
        </p>    
        <p>
            <label>E-mail:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" name="email" type="text">
        </p>
        <p>
            <label>Data de Nascimento:</label>
            <input value="<?php if(isset($_POST['data_nascimento'])) echo $_POST['data_nascimento'];?>" name="data_nascimento" type="date">
        </p>
        <p>
            <label>Endereço:</label>
            <input value="<?php if(isset($_POST['endereco'])) echo $_POST['endereco'];?>" name="endereco" type="text">
        </p>    
        <p>
            <label>Telefone:</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>
        <p>
            <button type="submit">Salvar Aluno</button>        
    </form>    
</body>
</html>