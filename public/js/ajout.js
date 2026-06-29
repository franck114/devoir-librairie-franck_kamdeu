document.addEventListener('DOMContentLoaded', () => {
    // Variables pour gérer le panier et les favoris
    let panier = JSON.parse(localStorage.getItem("panier")) || []
    let favorisList = JSON.parse(localStorage.getItem("favoris")) || []
    
    const countElement = document.querySelector("#count")
    const favorisElement = document.querySelector("#favoris")
    
    // Initialisation des compteurs au chargement
    if(countElement) countElement.textContent = panier.reduce((acc, p) => acc + p.quantite, 0)
    if(favorisElement) favorisElement.textContent = favorisList.length

    // --- AJOUT AU PANIER ---
    const bouttonsPanier = document.querySelectorAll(".panier")
    bouttonsPanier.forEach((boutton) => {
        boutton.addEventListener("click", () => {
            const tr = boutton.closest("tr")
            if (!tr) return; // Sécurité si le bouton n'est pas dans un <tr>
            
            // Récupération des données du livre
            const imageEl = tr.querySelector("img.cover");
            const image = imageEl ? imageEl.src : '';
            const titre = tr.querySelector(".titre").textContent.trim()
            const auteur = tr.querySelector(".auteur").textContent.trim()
            const prixText = tr.querySelector(".prix").textContent.trim()
            const genre = tr.querySelector(".badge").textContent.trim()
            const id = boutton.getAttribute("data-id");

            let panierData = JSON.parse(localStorage.getItem("panier")) || []
            const index = panierData.findIndex(p => p.id === id)
            
            if (index !== -1) {
                // S'il existe déjà, on augmente la quantité
                panierData[index].quantite++
            } else {
                // Sinon on l'ajoute avec quantité 1
                panierData.push({ id, image, titre, auteur, prix: prixText, genre, quantite: 1 })
            }
            
            // Sauvegarde dans localStorage
            localStorage.setItem("panier", JSON.stringify(panierData))
            
            // Mise à jour du compteur dans le header
            if(countElement) countElement.textContent = panierData.reduce((acc, p) => acc + p.quantite, 0)
            
            alert("Livre ajouté au panier !");
        })
    })

    // --- AJOUT AUX FAVORIS ---
    const bouttonsFavoris = document.querySelectorAll(".favoris")
    bouttonsFavoris.forEach((boutton) => {
        const id = boutton.getAttribute("data-id");

        // Si le produit est déjà dans les favoris, on met à jour l'apparence
        if (favorisList.some(f => f.id === id)) {
            boutton.style.backgroundColor = "var(--anthracite)"
            boutton.innerHTML = '<i class="fas fa-heart"></i> Retirer des favoris'
        }

        boutton.addEventListener("click", () => {
            let favs = JSON.parse(localStorage.getItem("favoris")) || []
            const tr = boutton.closest("tr")
            if (!tr) return;
            
            const imageEl = tr.querySelector("img.cover");
            const image = imageEl ? imageEl.src : '';
            const titre = tr.querySelector(".titre").textContent.trim()
            const auteur = tr.querySelector(".auteur").textContent.trim()
            const prixText = tr.querySelector(".prix").textContent.trim()
            const genre = tr.querySelector(".badge").textContent.trim()

            const index = favs.findIndex(f => f.id === id)
            
            if (index === -1) {
                // Ajouter aux favoris
                favs.push({ id, image, titre, auteur, prix: prixText, genre })
                boutton.style.backgroundColor = "var(--anthracite)"
                boutton.innerHTML = '<i class="fas fa-heart"></i> Retirer des favoris'
            } else {
                // Retirer des favoris
                favs.splice(index, 1)
                boutton.style.backgroundColor = ""
                boutton.innerHTML = '<i class="fas fa-heart"></i> Ajouter aux favoris'
            }
            
            // Sauvegarde et mise à jour de l'affichage
            localStorage.setItem("favoris", JSON.stringify(favs))
            if(favorisElement) favorisElement.textContent = favs.length
        })
    })
})
