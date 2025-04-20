<?php
session_start();
include("config/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save'])) {
    $name = $_POST['name'];

    $image = $_FILES['image']['name'];
    $video = $_FILES['video']['name'];
    $file = $_FILES['file']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/$image");
    move_uploaded_file($_FILES['video']['tmp_name'], "uploads/videos/$video");
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/documents/$file");

    $stmt = $pdo->prepare("INSERT INTO articles (name, image, video, file) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $image, $video, $file]);

    header("Location: dashboard.php");
}
?>
<?php include("includes/header.php"); ?>
<div class="container mt-4">
    <h2>Ajouter un article</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nom de l'article</label>
        <input type="text" name="name" class="form-control mb-2" required>

        <label>Image</label>
        <input type="file" name="image" class="form-control mb-2" accept="image/*">

        <label>Vidéo</label>
        <input type="file" name="video" class="form-control mb-2" accept="video/*">

        <label>Fichier (PDF ou autre)</label>
        <input type="file" name="file" class="form-control mb-2" accept=".pdf,.doc,.docx,.txt">

        <button type="submit" name="save" class="btn btn-success">Enregistrer</button>
        <a href="dashboard.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?php include("includes/footer.php"); ?>
