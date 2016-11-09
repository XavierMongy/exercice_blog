<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>blog</title>
  </head>
  <body>
    <h1>Mon blog</h1>
    <p>Derniers billets du blog : </p>

<?php

//Connection to database
try {
  $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'Javieres9');

} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}

//Fetch and display billets
$req = $bdd->query('SELECT id, title, content, DATE_FORMAT(date_publication, \'%d%m%Y à %Hh%imin%ss\') AS date_publication FROM billets ORDER BY date_publication DESC LIMIT 0, 5 ');
while ($donnees = $req->fetch()) {
?>

  <h2><?php echo htmlspecialchars($donnees['title']); ?> le <?php echo $donnees['date_publication']; ?></h2>
  <p><?php echo htmlspecialchars($donnees['content']); ?></p>

  <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a>

<?php
}
$req->closeCursor();
?>
  </body>
</html>
