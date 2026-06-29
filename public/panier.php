<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/lib.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Panier || LIBRAIRIE LA PLUME</title>
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
.liv{
    text-align: center;
    margin: 20px;
}
.grille{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 20px;
}
.livres{
    border: 1px solid var(--bordeaux);
    padding: 20px;
    text-align: center;
}
.livres img{
    width: 100%;
    height: 200px;
}
.panier{
    background-color: var(--dore);
    color: var(--blanc-casse);
    border: none;
    padding: 10px;
    cursor: pointer;
}
.favoris{
    background-color: var(--bordeaux);
    color: var(--blanc-casse);
    border: none;
    padding: 10px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}
table th, table td {
    border: 1px solid var(--bordeaux);
    padding: 10px;
    text-align: center;
}
table th {
    background-color: var(--bordeaux);
    color: var(--blanc-casse);
}
table img {
    width: 100px;
    height: 100px;
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
                    <li><a href="livre.php">Livres</a></li>
                    <li><a href="favoris.php"><i class="fas fa-heart"></i> <span id="favoris">0</span></a></li>
                    <li><a href="#"><i class="fas fa-shopping-cart"></i> <span id="count">0</span></a></li>
                    <li><a href="mon_compte.php">Mon compte</a></li>
                    <li><a href="gestion.php">Gestion</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="liv">
            <h1>
                PANIER
            </h1>
            <p>
                voici les livres que vous avez ajoute au panier 
            </p>
        </div>
        <table id="tableau-panier">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Prix</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="list-panier">
                <!-- les livres mis au panier seront afficher ici -->
            </tbody>
        </table>

    </main>
    <footer>
        <div class="footer">
            <p>&copy; 2026 Librairie La Plume. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="js/lib.js"></script>
</body>
</html>