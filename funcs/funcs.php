<?php
use PHPMailer\PHPMailer\PHPMailer;


function enviarEmail($email, $nombre, $asunto, $cuerpo){


    require("PHPMailer-master/src/PHPMailer.php");
    require("PHPMailer-master/src/Exception.php");
    require("PHPMailer-master/src/SMTP.php");
    // $mail = new PHPMailer();

    $mail = new PHPMailer(); 
    // $mail->SMTPDebug = 2; Usar para verificar errores
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";

    // $mail->CharSet="UTF-8";

    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPSecure = 'tipo de seguridad';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "proyectoptc24@gmail.com";
    $mail->Password = "fqbjadjodxumaxao";


    // $mail->SetFrom('miemail@dominio.com', 'Sistema con PHP');
    // $mail->AddAddress($email, $nombre);
    $mail->SetFrom('proyectoptc24@gmail.com', 'Banko');
    $mail->AddAddress($email, $nombre);

    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->IsHTML(true);

    if($mail->Send())
    return true;
    else
    return false;
}

function isEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function emailExiste($email)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT id_user FROM usuarios WHERE email = ? LIMIT 1"); 
        $stmt->bind_param("s", $email); 
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();

        if($num > 0){
            return true;
        }else{
            return false;
        }
    }


    function generateTokenPass($user_id)
    {
        global $mysqli;
        $token = generateToken();
     

        $stmt = $mysqli->prepare("UPDATE usuarios SET token = ?, WHERE id_user = ?");
        $stmt->bind_param('ss', $token, $user_id);
        $stmt->execute();
        $stmt->close();

        return $token;
    }
    function getValor($campo, $campoWhere, $valor)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;

        if($num > 0 )
        {
            $stmt->bind_result($resultado);
            $stmt->fetch();
            return $resultado;
        }
        else
        {
            $errors = 'El correo no existe';
        }
        return $errors;
    }
    function generateToken(){
        $gen = md5(uniqid(mt_rand(), false));
        return $gen;
    }
?>
