<?php
include("banco-Usuario.php");

use PHPMailer\PHPmailer\PHPMailer;
use PHPMailer\PHPmailer\SMTP;
use PHPMailer\PHPmailer\Exception;

require './vendor/autoload.php';



session_start();
ob_start();

function usuarioEstaLogado()
{
    return isset($_SESSION["usuario_logado"]);
}

function verificaUsuario()
{
    if (!usuarioEstaLogado()) {
        $_SESSION["danger"] = "Você não esta tem acesso a essa funcionalidade";
        header("Location: dashboard.php?falhaDeSeguranca=true");
        die();
    }
}

function usuarioLogado()
{
    return $_SESSION["usuario_logado"];
}

function logaUsuario($email)
{
    $_SESSION["usuario_logado"] = $email;
}

function logout()
{
    session_destroy();
    session_start();
}

function verifica_dados($conn)
{
    if (isset($_POST['env']) && $_POST['env'] == "form") {
        $email = addslashes($_POST['email']);
        $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $get = $sql->get_result();
        $total = $get->num_rows;

        if ($total > 0) {
            $dados = $get->fetch_assoc();
            add_dados_recover($conn, $email);
        } else {
        }
    }
}

function add_dados_recover($conn, $email)
{
    $rash = md5(rand());
    $sql = $conn->prepare("INSERT INTO recover_solicitation (email, rash) VALUE (?, ?)");
    $sql->bind_param("ss", $email, $rash);
    $sql->execute();

    if ($sql->affected_rows > 0) {
        enviar_email($conn, $email, $rash);
    }
}

function enviar_email($conn, $email, $rash)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'mtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '61e69faa35f6fe';
        $mail->Password = '772a506af665df';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;

        $mail->setFrom('grupodevenix@gmail.com', 'Atendimento Devenix');
    } catch (Exception $e) {
        echo 'Erro';
    }
}
/*
function verifica_hash($conn, $rash)
{
    $sql = $conn->prepare("SELECT * FROM recovery_solicitation WHERE rash = ? AND status = 0");
    $sql->bind_param("s", $_GET['rash']);
    $sql->execute();
    $get = $sql->get_result();
    $total = $get->num_rows;

    if ($total > 0) {
        echo "Pode efetuar alterações ";
    } else {
        echo "<div class='alert alert-danger'>Rash invalido.</div>".
    }
}
*/