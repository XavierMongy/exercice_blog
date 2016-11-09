<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
  </head>
  <body>
    <h1>Blog</h1>
    <a href="index.php">Retour à la liste des billets</a>

<?php
//Connection to database
try {
  $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}

//Fetch and display billet
$req = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(date_publication, \'%d%m%Y à %Hh%imin%ss\') AS date_publication FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();
?>

    <h2><?php echo htmlspecialchars($donnees['title']); ?> le <?php echo $donnees['date_publication']; ?></h2>
    <p><?php echo htmlspecialchars($donnees['content']) ?></p>

<?php
$req->closeCursor();

//Fetch and display comments
$req = $bdd->prepare('SELECT id, nickname, content_comment, DATE_FORMAT(date_comment, \'%d%m%Y à %Hh%imin%ss\') AS date_comment FROM comment WHERE billet_id = ? ORDER BY date_comment');
$req->execute(array($_GET['billet']));
while ($donnees = $req->fetch()) {
?>

  <p>Commentaires</p>
  <p><?php echo htmlspecialchars($donnees['nickname']); ?> le <?php echo $donnees['date_comment']; ?></p>
  <p><?php echo htmlspecialchars($donnees['content_comment']); ?></p>


<?php
}
$req->closeCursor();
?>


  </body>
</html>
