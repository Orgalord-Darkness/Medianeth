<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Administration — Movies</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h1 class="mb-4">Administration — Movies</h1>

    <?php if (count($books) === 0){ ?>
      <div class="alert alert-secondary text-center">Aucun film trouvé.</div>
    <?php }else{ ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle bg-white shadow-sm rounded">
          <thead class="table-primary">
            <tr>
              <th scope="col">Titre</th>
              <th scope="col">Auteur</th>
              <th scope="col">Nombre de chansons</th>
              <th scope="col">Editeur</th>
              <th scope="col">Disponibilité</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($albums as $row): ?>
              <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= (int)$row['songNumber'] ?></td>
                <td><?= htmlspecialchars($row['editor']) ?></td>
                <td>
                  <?php if ($row['disponibility']): ?>
                    <span class="badge bg-success">Disponible</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Indisponible</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="#" class="btn btn-sm btn-outline-primary">Voir</a>
                  <a href="#" class="btn btn-sm btn-outline-warning">Éditer</a>
                  <a href="#" class="btn btn-sm btn-outline-danger">Supprimer</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php }; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>