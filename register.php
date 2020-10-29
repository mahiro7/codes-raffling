<?php 
require_once "db_functions.php";

$error = false;
$success = false;

$code = $name = $birth = $cpf = '';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["birth"]) && isset($_POST["cpf"])){
        $conn = connect_db();

        $code = mysqli_real_escape_string($conn,$_POST["code"]);
        $name = mysqli_real_escape_string($conn,$_POST["name"]);
        $birth = mysqli_real_escape_string($conn,$_POST["birth"]);
        $cpf = mysqli_real_escape_string($conn,$_POST["cpf"]);

        $sql = "SELECT * FROM `$table_codes` WHERE code = '$code'";
        $result = mysqli_query($conn, $sql);

        if($result){
            if (mysqli_num_rows($result) > 0){
                $verificador = true;
            }
            else{
                $cadastro = false;
                $verificador = false;
                $error_msg = "Código inválido!";
                $error = true;
            }
        }
    }
    else{
        $error_msg = "Preencha todos dados!";
        $error = true;
    }

    if ($verificador == true){
        $verify = "SELECT * FROM `$table_users` WHERE code = '$code'";
        $result = mysqli_query($conn, $verify);

        if($result){
            if (mysqli_num_rows($result) > 0){
                $cadastro = false;
                $error_msg = "Código já utilizado!";
                $error = true;
            }
            else{
                $cadastro = true;
            }
        }
    }

    if ($cadastro == true){
        $sql = "INSERT INTO `$table_users`
        (code, nome, nasc, CPF)
        VALUES ('$code', '$name', '$birth', '$cpf');";

        if(mysqli_query($conn, $sql)){
            $success = true;
        }
        else{
            $error_msg = mysqli_error($conn);
            $error = true;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Cadastro Sorteio</title>
</head>

<body>
    <div class="sortbox">
        <form action="register.php" method="POST">
            <p>Código:</p></li>
            <input type="text" name="code" value="<?php echo $code; ?>" required>
            <p>Nome completo:</p>
            <input type="text" name="name" value="<?php echo $name; ?>" required>
            <p>Data de Nascimento:</p>
            <input type="date" name="birth" value="<?php echo $birth; ?>" required>
            <p>CPF:</p>
            <input type="text" name="cpf" value="<?php echo $cpf; ?>" required>
            <br>
            <input type="submit">
        </form>
    </div>

    <?php if ($success): ?>
    <h3>Cadastro feito <?php echo $code ?></h3>
    <?php endif; ?>

    <?php if ($error): ?>
        <h3 style="color:red;"><?php echo $error_msg; ?></h3>
    <?php endif; ?>

</body>
</html>