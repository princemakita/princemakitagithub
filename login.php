<?php
session_start();
include("config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = hash("sha256", $_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
    } else {
        $error = "Identifiants incorrects";
    }
}
?>
<?php include("includes/header.php"); ?>
<style>
    body {
        background: linear-gradient(120deg, indigo, green, yellow, blue, brown, violet, red, orange);
        color: white;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-dark p-4 rounded shadow">
            <div class="text-center mb-3">
                <img src="includes/default_logo.png" id="top-image" style="max-width: 120px;" class="mb-2 rounded-circle">
                <p class="text-light">Vous pouvez remplacer cette image dans le dossier <strong>includes</strong></p>
            </div>
            <h3 class="text-center">Connexion</h3>
            <?php if(isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <input type="text" name="username" class="form-control mb-2" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
                <button class="btn btn-primary w-100">Connexion</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
