document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENTS GLOBAUX ---
    const countElement = document.querySelector("#count")
    const favorisElement = document.querySelector("#favoris")

    // --- RECUPERATION DES DONNEES ---
    let panier = JSON.parse(localStorage.getItem("panier")) || []
    let favorisList = JSON.parse(localStorage.getItem("favoris")) || []

    // -- MISE A JOUR DES COMPTEURS AU CHARGEMENT ---
    if(countElement) countElement.textContent = panier.reduce((acc, p) => acc + p.quantite, 0)
    if(favorisElement) favorisElement.textContent = favorisList.length

    // --- GESTION DE L'AFFICHAGE DES FAVORIS ---
    const favorisListTable = document.getElementById("favoris-list")
    
    if (favorisListTable) {
        afficherFavoris();
    }

    function afficherFavoris() {
        favorisListTable.innerHTML = ""

        if (favorisList.length === 0) {
            favorisListTable.innerHTML = `
                <tr>
                    <td colspan="6" style="padding: 2rem;">Vous n'avez pas encore de favoris ❤️</td>
                </tr>
            `
            return
        }

        favorisList.forEach((produit, index) => {
            const ligne = document.createElement("tr")
            ligne.innerHTML = `
                <td>
                   ${produit.image ? `<img src="${produit.image}" alt="${produit.titre}" class="cover" style="width: 50px; height: auto;" onerror="this.style.display='none'">` : '<div class="cover-placeholder"></div>'}
                </td>
                <td><div class="titre">${produit.titre}</div></td>
                <td><div class="auteur">${produit.auteur}</div></td>
                <td class="prix">${produit.prix}</td>
                <td><span class="badge">${produit.genre}</span></td>
                <td>
                    <button class="panier" onclick="ajouterAuPanierDepuisFav(${index})"><i class="fas fa-shopping-cart"></i> Ajouter au panier</button>
                    <button class="favoris" style="background-color: var(--anthracite);" onclick="supprimerFavori(${index})"><i class="fas fa-trash"></i> Retirer</button>
                </td>
            `
            // J'ajoute le colspan pour aligner avec les headers même s'il manque la colonne genre à cet index là dans le thead ou pas, ici la page favoris a 6 colonnes
            let td = document.createElement("td");
            favorisListTable.appendChild(ligne)
        })
    }

    window.supprimerFavori = function(index) {
        favorisList.splice(index, 1)
        localStorage.setItem("favoris", JSON.stringify(favorisList))
        if(favorisElement) favorisElement.textContent = favorisList.length
        afficherFavoris()
    }

    window.ajouterAuPanierDepuisFav = function(index) {
        const produit = favorisList[index]
        const i = panier.findIndex(p => p.id === produit.id)
        if (i !== -1) {
            panier[i].quantite++
        } else {
            panier.push({ ...produit, quantite: 1 })
        }
        localStorage.setItem("panier", JSON.stringify(panier))
        if(countElement) countElement.textContent = panier.reduce((acc, p) => acc + p.quantite, 0)
        alert("Livre ajouté au panier !");
    }

    // --- GESTION DE L'AFFICHAGE DU PANIER ---
    const listePanierTable = document.getElementById('list-panier')
    let totalElement = document.getElementById('total')
    
    if (listePanierTable) {
        if (!totalElement) {
            // Création de l'élément d'affichage du total en bas du tableau
            const table = document.getElementById('tableau-panier')
            const totalDiv = document.createElement('div')
            totalDiv.innerHTML = '<h3 id="total" style="text-align: right; margin-right: 20px; font-weight: bold; color: var(--bordeaux);">Total : 0.00 €</h3>'
            table.parentNode.insertBefore(totalDiv, table.nextSibling)
            totalElement = document.getElementById('total')
        }
        afficherPanier()
    }

    function afficherPanier() {
        listePanierTable.innerHTML = ''
        let totaldepart = 0
        
        if (panier.length === 0) {
            listePanierTable.innerHTML = `
                <tr>
                    <td colspan="6" style="padding: 2rem;">Votre panier est vide</td>
                </tr>
            `
            totalElement.textContent = `Total : 0.00 €`
            return
        }

        panier.forEach((produit, index) => {
            // Nettoyage et conversion du prix
            const prixNum = parseFloat(produit.prix.replace('€', '').replace(',', '.').replace(/[^0-9.]/g, ''))
            const totalProduit = prixNum * produit.quantite
            totaldepart += totalProduit
            
            const ligne = document.createElement('tr')
            ligne.innerHTML = `
                <td>
                   ${produit.image ? `<img src="${produit.image}" alt="${produit.titre}" class="cover" style="width: 50px; height: auto;" onerror="this.style.display='none'">` : '<div class="cover-placeholder"></div>'}
                </td>
                <td><div class="titre">${produit.titre}</div></td>
                <td><div class="auteur">${produit.auteur}</div></td>
                <td class="prix">${produit.prix}</td>
                <td><span class="badge">${produit.genre}</span></td>
                <td>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <button class="panier" style="padding: 5px 10px; background: var(--anthracite);" onclick="modifierQuantite(${index}, -1)">-</button>
                        <span>${produit.quantite}</span>
                        <button class="panier" style="padding: 5px 10px;" onclick="modifierQuantite(${index}, 1)">+</button>
                        <button class="favoris" style="padding: 5px 10px; background-color: var(--anthracite);" onclick="supprimerProduit(${index})"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            `
            listePanierTable.appendChild(ligne)
        })
        totalElement.textContent = `Total : ${totaldepart.toFixed(2)} €`
    }

    window.supprimerProduit = function(index) {
        panier.splice(index, 1)
        localStorage.setItem('panier', JSON.stringify(panier))
        if(countElement) countElement.textContent = panier.reduce((acc, p) => acc + p.quantite, 0)
        afficherPanier()
    }

    window.modifierQuantite = function(index, delta) {
        if (panier[index].quantite + delta > 0) {
            panier[index].quantite += delta;
        } else {
            panier.splice(index, 1);
        }
        localStorage.setItem('panier', JSON.stringify(panier))
        if(countElement) countElement.textContent = panier.reduce((acc, p) => acc + p.quantite, 0)
        afficherPanier()
    }
})
