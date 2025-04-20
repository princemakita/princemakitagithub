<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include("config/db.php");

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: dashboard.php");
}

$articles = $pdo->query("SELECT * FROM articles ORDER BY id DESC")->fetchAll();
?>
<?php include("includes/header.php"); ?>
<div class="container mt-4">
    <h2 class="mb-3">Tableau de bord - Articles</h2>
    <a href="add_article.php" class="btn btn-success mb-3">Ajouter un article</a>
    <a href="logout.php" class="btn btn-danger mb-3 float-end">Quitter</a>
    <div class="row">
        <?php foreach($articles as $article): ?>
        <div class="col-md-4 mb-3">
            <div class="card border rounded shadow p-2" style="background: linear-gradient(45deg, indigo, green, yellow, blue, brown, violet, red, orange); color: white;">
                <div class="card-body">
                    <h5><?= htmlspecialchars($article['name']) ?></h5>
                    <?php if($article['image']): ?><img src="uploads/images/<?= $article['image'] ?>" class="img-fluid mb-2"><?php endif; ?>
                    <?php if($article['video']): ?><video src="uploads/videos/<?= $article['video'] ?>" class="w-100" controls></video><?php endif; ?>
                    <?php if($article['file']): ?><a href="uploads/documents/<?= $article['file'] ?>" class="btn btn-light mt-2">Voir Fichier</a><?php endif; ?>
                    <div class="mt-2">
                        <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?delete=<?= $article['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet article ?');">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include("includes/footer.php"); ?>
