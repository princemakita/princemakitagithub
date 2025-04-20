<?php
// Cette page servira d'exemple pour l'envoi d'e-mail (fonction mail à configurer avec un serveur SMTP ou PHPMailer)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (mail($to, $subject, $message)) {
        $status = "Message envoyé avec succès.";
    } else {
        $status = "Échec de l'envoi.";
    }
}
?>
<?php include("includes/header.php"); ?>
<div class="container mt-4">
    <h2>Envoyer un email à un client</h2>
    <?php if(isset($status)): ?><div class="alert alert-info"><?= $status ?></div><?php endif; ?>
    <form method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email du client" required>
        <input type="text" name="subject" class="form-control mb-2" placeholder="Sujet" required>
        <textarea name="message" class="form-control mb-2" rows="4" placeholder="Message" required></textarea>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
