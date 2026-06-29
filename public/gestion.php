<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion || LIBRAIRIE LA PLUME</title>
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
form{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 20px;
    border: 4px solid var(--bordeaux);
    border-radius: 5px;
    padding: 20px;
    width: 50%;
    margin-left: 25%;
    margin-right: 25%;
}
label{
    margin: 10px;
}
input{
    padding: 10px;
    margin: 10px;
    border: 1px solid var(--bordeaux);
    border-radius: 5px;
}
button{
    padding: 10px;
    margin: 10px;
    background-color: var(--dore);
    color: var(--blanc-casse);
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
a{
    color: var(--bordeaux);
    text-decoration: none;
}
.connexion{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 20px;
    border: 1px solid var(--bordeaux);
    border-radius: 5px;
    padding: 20px;
    width: 50%;
    margin-left: 25%;
    margin-right: 25%;
}


</style>
<body>
    <form action="">
        <div class="connexion">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <button type="submit">Se connecter</button>

        </div>
    </form>
</body>
</html>