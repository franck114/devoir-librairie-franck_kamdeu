<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil || LIBRAIRIE LA PLUME</title>
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

footer{
    background-color: var(--bordeaux);
    color: var(--blanc-casse);
    text-align: center;
    padding: 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>

<body>
    <header>
        <div class="entete">
            <div class="logo">
                <a href="#">
                    LA PLUME NUMERIQUE
                </a>
            </div>
            
            <div class="lien">
                <ul>
                    <li><a href="#">Acceuil</a></li>
                    <li><a href="livre.php">Livres</a></li>
                </ul>
            </div>
        </div>
    </header>

    <footer>
        <div class="footer">
            <p>&copy; 2026 Librairie La Plume. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>