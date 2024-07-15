<?php
use PHPMailer\PHPMailer\PHPMailer;


// function enviarEmail($email, $nombre, $asunto, $cuerpo){


//     require("PHPMailer-master/src/PHPMailer.php");
//     require("PHPMailer-master/src/Exception.php");
//     require("PHPMailer-master/src/SMTP.php");
//     // $mail = new PHPMailer();

//     $mail = new PHPMailer(); 
//     // $mail->SMTPDebug = 2; Usar para verificar errores
//     $mail->IsSMTP();
//     $mail->SMTPAuth = true;
//     $mail->SMTPSecure = "tls";

//     // $mail->CharSet="UTF-8";

//     // $mail->Host = 'smtp.gmail.com';
//     // $mail->SMTPSecure = 'tipo de seguridad';
//     $mail->Host = "smtp.gmail.com";
//     $mail->Port = 587;
//     $mail->Username = "proyectoptc24@gmail.com";
//     $mail->Password = "fqbjadjodxumaxao";


//     // $mail->SetFrom('miemail@dominio.com', 'Sistema con PHP');
//     // $mail->AddAddress($email, $nombre);
//     $mail->SetFrom('proyectoptc24@gmail.com', 'Banko');
//     $mail->AddAddress($email, $nombre);

//     $mail->Subject = $asunto;
//     $mail->Body = $cuerpo;
//     $mail->IsHTML(true);

//     if($mail->Send())
//     return true;
//     else
//     return false;
// }

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
    function encryptPayload($plainText) {
        $key = '7<xwv,9j%N%.!0LEsSwc.Ca3X!SdAO|/';  
        $iv = '<w,jN.0EScC3!dO/'; 
       
        $encrypted = openssl_encrypt($plainText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $payload = base64_encode($iv . $encrypted); 
       
        return $payload;
      }
    function decryptPayload($encryptedPayload) {
        $key = '7<xwv,9j%N%.!0LEsSwc.Ca3X!SdAO|/';
        $data = base64_decode($encryptedPayload);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLength);
        $encryptedText = substr($data, $ivLength);
        $decrypted = openssl_decrypt($encryptedText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
     }

     function generateCsrfToken() {
        return bin2hex(random_bytes(32));
    }
    
    function validateCsrfToken($token) {
        return $token === $_SESSION['csrf_token'];
    }