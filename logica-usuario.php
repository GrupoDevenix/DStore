<?php
include("banco-Usuario.php");

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
    $destinatario = $email;

    $subject = "RECUPERAR SENHA";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $message = "<html><head>";
    $message .= "
    <h2>Você solicitou uma nova senha?</h2>
    <h3>Se sim, aqui esta o link para recuperar a sua senha</h3>
    <p>Para recuperar sua senha acesse esse link: <a href='" . "http://localhost/DStore/alterar.php" .
        $rash . "'</a></p>
    <h5>Se não foi você que solicitou ignore este email, porém alguém tentou alterar seus dados.</h5>
    Atenciosamente, Grupo Devenix.
    ";
    $message .= "</head></html>";

    if (mail($destinatario, $subject, $message, $headers)) {
        echo "<div class='alert-success> Os dados foram enviados para seu email. Acesse para recuperar'</div>";
    } else {
        echo "<div class='alert-danger'>Erro ao enviar</div>";
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