<?php
// admin_books_view.php
// Vue PHP pour l'administration des livres
// Attendu :
//   - $books : array of associative arrays with keys: titre, auteur, disponible (bool), pages

if (!isset($books)) {
    $books = [
        ['titre' => 'Le Petit Prince', 'auteur' => 'Antoine de Saint-Exupéry', 'disponible' => true, 'pages' => 96],
        ['titre' => 'L\'Etranger', 'auteur' => 'Albert Camus', 'disponible' => false, 'pages' => 185],
        ['titre' => 'Les Misérables', 'auteur' => 'Victor Hugo', 'disponible' => true, 'pages' => 1232],
    ];
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Administration — Livres</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f6f8fa; margin:0; padding:20px;}
    h1{margin-bottom:20px;}
    table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;}
    thead{background:#2463eb;color:#fff;}
    th,td{padding:12px;text-align:left;border-bottom:1px solid #eee;}
    tr:hover{background:#f0f2f5;}
    .status{padding:4px 8px;border-radius:4px;font-size:12px;font-weight:bold;}
    .status.ok{background:#d1fae5;color:#065f46;}
    .status.no{background:#fee2e2;color:#991b1b;}
    .actions a{margin-right:8px;text-decoration:none;color:#2463eb;font-weight:bold;}
    .empty{padding:20px;text-align:center;color:#666;background:#fff;border-radius:8px;}
  </style>
</head>
<body>
  <h1>Administration — Livres</h1>

  <?php if (count($books) === 0){ ?>
    <div class="empty">Aucun livre trouvé.</div>
  <?php }else{ ?>
    <table>
      <thead>
        <tr>
          <th>Titre</th>
          <th>Auteur</th>
          <th>Pages</th>
          <th>Disponibilité</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book): ?>
          <tr>
            <td><?= htmlspecialchars($book['titre']) ?></td>
            <td><?= htmlspecialchars($book['auteur']) ?></td>
            <td><?= (int)$book['pages'] ?></td>
            <td>
              <?php if ($book['disponible']): ?>
                <span class="status ok">Disponible</span>
              <?php else: ?>
                <span class="status no">Indisponible</span>
              <?php endif; ?>
            </td>
            <td class="actions">
              <a href="#">Voir</a>
              <a href="#">Éditer</a>
              <a href="#" style="color:#d64545">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php }; ?>
</body>
</html>
