<?php
// ── Connexion à la base de données ──────────────────────────────────────────
$host   = 'localhost';
$dbname = 'librairie';   
$user   = 'root';           
$pass   = '';               

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<p class="error">Connexion échouée : ' . htmlspecialchars($e->getMessage()) . '</p>');
}

// ── Récupération des livres ──────────────────────────────────────────────────
$stmt = $pdo->query("SELECT * FROM livres ORDER BY titre ASC");
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalogue de livres</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <style>
    /* ── Tokens ─────────────────────────────────────────────── */
    :root {
      --ink:      #1a1a2e;
      --paper:    #f7f4ef;
      --accent:   #c0392b;
      --muted:    #7f8c8d;
      --border:   #e0dbd3;
      --card-bg:  #ffffff;
      --shadow:   0 2px 12px rgba(0,0,0,.07);
    }

    /* ── Reset & base ────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--paper);
      color: var(--ink);
      min-height: 100vh;
    }

    /* ── Header ──────────────────────────────────────────────── */
    header {
      background: var(--ink);
      color: #fff;
      padding: 2.5rem 2rem 2rem;
      text-align: center;
    }
    header h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 5vw, 3rem);
      letter-spacing: -.5px;
    }
    header p {
      margin-top: .5rem;
      color: rgba(255,255,255,.55);
      font-size: .9rem;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    /* ── Main ────────────────────────────────────────────────── */
    main {
      max-width: 1100px;
      margin: 2.5rem auto;
      padding: 0 1.25rem 3rem;
    }

    /* ── Barre de stats ──────────────────────────────────────── */
    .stats {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }
    .stat {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: .75rem 1.25rem;
      font-size: .85rem;
      color: var(--muted);
    }
    .stat strong { color: var(--ink); font-size: 1.1rem; display: block; }

    /* ── Table ───────────────────────────────────────────────── */
    .table-wrap {
      background: var(--card-bg);
      border-radius: 12px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: .93rem;
    }
    thead {
      background: var(--ink);
      color: #fff;
    }
    thead th {
      padding: 1rem 1.25rem;
      text-align: left;
      font-weight: 500;
      letter-spacing: .05em;
      font-size: .8rem;
      text-transform: uppercase;
    }
    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background .15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #faf8f5; }
    td {
      padding: .85rem 1.25rem;
      vertical-align: middle;
    }

    /* ── Couverture miniature ────────────────────────────────── */
    .cover {
      width: 44px;
      height: 60px;
      object-fit: cover;
      border-radius: 3px;
      box-shadow: 2px 2px 6px rgba(0,0,0,.18);
      display: block;
    }
    .cover-placeholder {
      width: 44px;
      height: 60px;
      background: var(--border);
      border-radius: 3px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
    }

    /* ── Titre + auteur empilés ──────────────────────────────── */
    .titre { font-weight: 600; }
    .auteur { font-size: .8rem; color: var(--muted); margin-top: 2px; }

    /* ── Badge genre ─────────────────────────────────────────── */
    .badge {
      display: inline-block;
      padding: .25rem .7rem;
      border-radius: 20px;
      font-size: .75rem;
      font-weight: 500;
      background: #eef0f8;
      color: var(--ink);
      white-space: nowrap;
    }

    /* ── Prix ────────────────────────────────────────────────── */
    .prix {
      font-weight: 600;
      color: var(--accent);
      white-space: nowrap;
    }

    /* ── Vide / erreur ───────────────────────────────────────── */
    .empty {
      text-align: center;
      padding: 3rem;
      color: var(--muted);
    }
    .error {
      background: #fdecea;
      color: var(--accent);
      padding: 1rem 1.5rem;
      border-radius: 8px;
      margin: 2rem auto;
      max-width: 600px;
    }

    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 640px) {
      thead th:nth-child(1),
      td:nth-child(1) { display: none; }   /* cache la colonne image */
      thead th:nth-child(5),
      td:nth-child(5) { display: none; }   /* cache genre sur mobile */
    }
  </style>
</head>
<body>

<header>
  <h1>Catalogue de livres</h1>
  <p>Bibliothèque en ligne</p>
</header>

<main>

  <?php if (empty($livres)): ?>
    <p class="empty">Aucun livre trouvé dans la base de données.</p>
  <?php else: ?>

    <!-- Stats rapides -->
    <div class="stats">
      <div class="stat">
        <strong><?= count($livres) ?></strong>
        Livres
      </div>
      <div class="stat">
        <strong><?= count(array_unique(array_column($livres, 'genre'))) ?></strong>
        Genres
      </div>
      <div class="stat">
        <strong><?= number_format(array_sum(array_column($livres, 'prix')) / count($livres), 2) ?> €</strong>
        Prix moyen
      </div>
    </div>

    <!-- Tableau -->
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Couverture</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($livres as $livre): ?>
          <tr>
            <td>
              <?php if (!empty($livre['image'])): ?>
                <img class="cover"
                     src="<?= htmlspecialchars($livre['image']) ?>"
                     alt="Couverture de <?= htmlspecialchars($livre['titre']) ?>"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="cover-placeholder" style="display:none">📖</div>
              <?php else: ?>
                <div class="cover-placeholder">📖</div>
              <?php endif; ?>
            </td>
            <td>
              <div class="titre"><?= htmlspecialchars($livre['titre']) ?></div>
              <div class="auteur"><?= htmlspecialchars($livre['auteur']) ?></div>
            </td>
            <td><span class="badge"><?= htmlspecialchars($livre['genre']) ?></span></td>
            <td class="prix"><?= number_format((float)$livre['prix'], 2, ',', '') ?> €</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  <?php endif; ?>

</main>

</body>
</html>
