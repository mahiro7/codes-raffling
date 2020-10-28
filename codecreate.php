<script>
function codeGen(len){
    let code = ''

    do{
        code += Math.random().toString(36).substring(2);
    }while(code.length =! len)

    return code.toUpperCase()
}
const si = 10

document.cookie=`codeGen=${codeGen(si)}`
</script>

<?php 
require "db_functions.php";

$error = false;
$success = false;
$client = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["client"])){

        $verificador = false;
        $conn = connect_db();

        $code = $_COOKIE['codeGen'];
        $verify = "SELECT * FROM `codes` WHERE code = '$code'";

        $result = mysqli_query($conn, $verify);
        if($result){
            if (mysqli_num_rows($result) > 0){
                $error_msg = "Código repetido, tente novamente!";
            }
            else{
                $verificador = true;
            }
        }

        if($verificador == true){
            $client = mysqli_real_escape_string($conn,$_POST["client"]);

            $sql = "INSERT INTO codes (code, client) VALUES 
            ('$code', '$client');";

            if(mysqli_query($conn, $sql)){
                $success = true;
            }
            else {
                $error_msg = mysqli_error($conn);
                $error = true;
            }
        }
        else {
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
    <title>Gerar Código</title>
</head>

<body>
    <div class="sortbox">
        <form action="codecreate.php" method="post">
            <p>Cliente:</p>
            <input type="text" name="client" value="<?php echo $client; ?>" required><br>
            <input type="submit">
        </form>
    </div>

    <?php if ($success): ?>
    <h3>Código gerado: <?php echo $code ?></h3>
    <?php endif; ?>

    <?php if ($error): ?>
        <h3 style="color:red;"><?php echo $error_msg; ?></h3>
    <?php endif; ?>
</body>
</html>