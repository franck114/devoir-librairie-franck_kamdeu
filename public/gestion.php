<?php
session_start();
require "db.php";


$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($admin = $result->fetch_assoc()) {
        if (password_verify($password, $admin["password"])) {
            session_regenerate_id(true);
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_username"] = $admin["username"];
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Mot de passe incorrect";
        }
    } else {
        $message = "Admin introuvable";
    }
}
?>


?>


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
    <h2>Connexion Admin</h2>
    <p style="color:red;"><?php echo $message; ?></p>

    <form method="post">
        <label>Nom d'utilisateur</label><br>
        <input type="text" name="username" required><br><br>

        <label>Mot de passe</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>