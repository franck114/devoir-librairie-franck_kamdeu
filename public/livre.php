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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/lib.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Livres || LIBRAIRIE LA PLUME</title>
</head>

<style>

@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@400;700&display=swap');


:root {

    --bordeaux: #6A1B2A;
    --dore: #C9A227;
    --creme: #FAF3E7;
    --anthracite: #2B2B2B;
    --blanc-casse: #FFFFFF;
    --police-titre: 'Playfair Display', serif;
    --police-texte: 'Lato', sans-serif;
}

body {
    font-family: var(--police-texte);
    color: var(--anthracite);
    background: var(--creme);
}

h1, h2, h3 {
    font-family: var(--police-titre);
    color: var(--bordeaux);
}
header{
    position: relative;
    top: 0;
    z-index: 1000;
}
.entete{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: var(--bordeaux);
    color: var(--blanc-casse);

}
ul {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0;
    margin: 0;
}
li {
    list-style-type: none;
    
}
a {
    text-decoration: none;
    color: var(--blanc-casse);
    margin: 0 10px;
}

    
    main {
      max-width: 1100px;
      margin: 2.5rem auto;
      padding: 0 1.25rem 3rem;
    }

    .table-wrap {
      background: var(--creme);
      border-radius: 12px;
      box-shadow: 2px 2px 6px rgba(0,0,0,.18);
      overflow: hidden;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: .93rem;
    }
    thead {
      background: var(--bordeaux);
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
      border-bottom: 1px solid var(--bordeaux);
      transition: background .15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #faf8f5; }
    td {
      padding: .85rem 1.25rem;
      vertical-align: middle;
    }

    
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

    
    .titre { font-weight: 600; }
    .auteur { font-size: .8rem; color: var(--muted); margin-top: 2px; }

    
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

    
    .prix {
      font-weight: 600;
      color: var(--accent);
      white-space: nowrap;
    }

    
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

    
    @media (max-width: 640px) {
      thead th:nth-child(1),
      td:nth-child(1) { display: none; }   
      thead th:nth-child(5),
      td:nth-child(5) { display: none; }   
    }

footer {
    background-color: var(--bordeaux);
    color: var(--blanc-casse);
    text-align: center;
    padding: 20px;
    position: sticky;
    bottom: 0;
}
@media (max-width: 768px) {
    .entete {
        flex-direction: column;
    }
    .lien ul {
        flex-direction: column;
    }
    .lien li {
        margin: 10px 0;
    }
    .grille{
        grid-template-columns: repeat(2, 1fr);
    }

}
</style>

<body>
    <header>
        <div class="entete">
            <div class="logo">
                <a href="index.php">
                    LA PLUME NUMERIQUE
                </a>
            </div>
            
            <div class="lien">
                <ul>
                    <li><a href="index.php">Acceuil</a></li>
                    <li><a href="#">Livres</a></li>
                    <li><a href="favoris.php"><i class="fas fa-heart"></i> <span id="favoris">0</span></a></li>
                    <li><a href="panier.php"><i class="fas fa-shopping-cart"></i> <span id="count">0</span></a></li>
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="#">Gestion</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>

  <?php if (empty($livres)): ?>
    <p class="empty">Aucun livre trouvé dans la base de données.</p>
  <?php else: ?>

    <h1 style="text-align: center;" >Livres</h1>

    <!-- Tableau -->
    <div class="grille">
      <table>
        <thead>
          <tr>
            <th>Couverture</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Prix</th>
            <th>Action</th>
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
                <div class="cover-placeholder" style="display:none"></div>
              <?php else: ?>
                <div class="cover-placeholder"></div>
              <?php endif; ?>
            </td>
            <td>
              <div class="titre"><?= htmlspecialchars($livre['titre']) ?></div>
              <div class="auteur"><?= htmlspecialchars($livre['auteur']) ?></div>
            </td>
            <td><span class="badge"><?= htmlspecialchars($livre['genre']) ?></span></td>
            <td class="prix"><?= number_format((float)$livre['prix'], 2, ',', '') ?> €</td>
            <td>
                <button class="panier" data-id="<?= $livre['id'] ?>">
                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                </button>
                <button class="favoris" data-id="<?= $livre['id'] ?>">
                    <i class="fas fa-heart"></i> Ajouter aux favoris
                </button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  <?php endif; ?>

</main>
    <footer>
        <div class="footer">
            <p>&copy; 2026 Librairie La Plume. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="js/ajout.js"></script>
</body>
</html>