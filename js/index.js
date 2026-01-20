// ********** FORMULAIRE **********
const form = document.querySelector("form");

if (form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const lastName = document.getElementById("lastName").value.trim();
    const firstName = document.getElementById("firstName").value.trim();
    const email = document.getElementById("email").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const message = document.getElementById("textarea").value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mobilePattern = /^[0-9]{10}$/;

    let isValid = true;

    if (!lastName) {
      document.getElementById("lastName").classList.add("error");
      isValid = false;
    }

    if (!firstName) {
      document.getElementById("firstName").classList.add("error");
      isValid = false;
    }

    if (!email) {
      document.getElementById("email").classList.add("error");
      isValid = false;
    }

    if (!mobile) {
      document.getElementById("mobile").classList.add("error");
      isValid = false;
    }

    if (!message) {
      document.getElementById("textarea").classList.add("error");
      isValid = false;
    }

    if (!isValid) {
      showErrorOrSuccess("Veuillez remplir tous les champs obligatoires !");
      return;
    }

    if (!emailPattern.test(email)) {
      document.getElementById("email").classList.add("error");
      showErrorOrSuccess("Veuillez entrer une adresse mail valide");
      return;
    }

    if (mobile && !mobilePattern.test(mobile)) {
      document.getElementById("mobile").classList.add("error");
      showErrorOrSuccess(
        "Votre numéro de téléphone doit contenir des chiffres (1,2,3...)"
      );
      return;
    }

    showErrorOrSuccess("Formulaire complété avec succés !", "success");
    form.reset();
  });

  // Pour enlever le border bottom rouge
  const inputs = document.querySelectorAll("input, textarea");

  inputs.forEach((input) => {
    input.addEventListener("input", () => {
      input.classList.remove("error");
    });
  });
}

// Mon message d'erreur/succés

function showErrorOrSuccess(msg, type = "error") {
  const formMessage = document.getElementById("form-message");
  const formText = document.getElementById("formText");
  const formIcon = document.getElementById("form-icon");

  // Vérifiez que ces éléments existent aussi
  if (!formMessage || !formText || !formIcon) return;
  formText.textContent = msg;
  formMessage.classList.remove("error", "success");
  formMessage.classList.add(type);

  if (type === "success") {
    formIcon.src = "images/succes.png";
    formIcon.alt = "logo succés";
  } else {
    formIcon.src = "images/traverser.png";
    formIcon.alt = "logo erreur";
  }

  formMessage.style.display = "flex";

  setTimeout(() => {
    formMessage.style.display = "none";
  }, 3000);
}

// PAGE 4 SYSTEME SOLAIRE

const url = window.location.origin + `/js/data/planetes.json`;
const containerS = document.getElementById("planetes-system");
const info = document.getElementById("info-planete");
const filtre = document.getElementById("filtre-planetes");
let planetesData = []; //  Variable globale qui va stocker TOUTES les planètes (vide au début, elle sera remplie après le fetch)

if (containerS && filtre) {
  //  Fonction qui prend en paramètre une liste de planètes à afficher (peut être toutes les planètes ou seulement les filtrées)
  function renderPlanetes(planetesAAfficher) {
    containerS.innerHTML = "";

    planetesAAfficher.forEach((p) => {
      const article = document.createElement("article");
      article.classList.add("art");
      article.innerHTML = `
      <div class="planet-img">
        <img src="${p.img}" alt="${p.nom}">
      </div>
    `;

      // Gestion du clic pour les détails
      article.addEventListener("click", () => {
        info.innerHTML = `
        <button id="close-info" style="position: absolute; top: 10px; right: 15px; background: none; border: none; color: #ff9500; font-size: 30px; cursor: pointer; font-weight: bold;">&times;</button>
        <h2>${p.nom}</h2>
        <p><strong>Type :</strong> ${p.type}</p>
        <p>Diamètre : ${p.diametre_km.toLocaleString("fr-FR")} km</p>
        <p>Masse : ${p.masse_kg} kg</p>
        <p>Distance Soleil : ${p.distance_au_soleil_km.toLocaleString(
          "fr-FR"
        )} km</p>
        <p>Lune(s) : ${p.lunes}</p>
      `;

        document.getElementById("close-info").addEventListener("click", () => {
          info.innerHTML = "";
        });
      });

      containerS.appendChild(article);
    });
  }

  // GESTION DU FILTRE
  filtre.addEventListener("change", (e) => {
    const valeur = e.target.value;

    const typeMapping = {
      tellurique: "Tellurique",
      gazeuse: "Géante gazeuse",
      glace: "Géante de glace",
    };

    let filteredList;
    if (valeur === "all") {
      filteredList = planetesData;
    } else if (valeur === "lunes") {
      filteredList = planetesData.filter((p) => p.lunes > 0);
    } else {
      filteredList = planetesData.filter((p) => p.type === typeMapping[valeur]);
    }

    renderPlanetes(filteredList);
  });

  async function chargerDonnees() {
    try {
      const response = await fetch(url);
      const data = await response.json();

      planetesData = data.planetes; // On remplit notre variable globale

      renderPlanetes(planetesData); // Premier affichage (toutes les planètes)
    } catch (error) {
      console.error("Erreur lors du chargement :", error);
    }
  }
  chargerDonnees();
}



// Page "Nos articles" 


async function lancerAffichage(){
  try {
    const reponse = await fetch('./js/data/articles.json');
    const donnees = await reponse.json();

    articlesData = donnees.articles;

    const grille = document.getElementById("grille-articles");

    articlesData.forEach(article => {
      const carteHtml = `
        <div class="card">
          <img src="${article.image}" alt="${article.titre}">
          <div class="card-infos">
            <small>${article.categorie}</small>
            <h3>${article.titre}</h3>
            <p>${article.resume}</p>
            <a href="details.html?id=${article.id}" class="btn">Lire l'article</a>
          </div>
        </div>
      `;
      grille.innerHTML += carteHtml;
    });
  } catch (erreur){
    console.error("Impossible de charger les articles :", erreur);
  }
}

lancerAffichage();


filtre.addEventListener("change", (e) => {
    const valeur = e.target.value;

    const typeMapping = {
      tellurique: "Tellurique",
      gazeuse: "Géante gazeuse",
      glace: "Géante de glace",
    };

    let filteredList;
    if (valeur === "all") {
      filteredList = planetesData;
    } else if (valeur === "lunes") {
      filteredList = planetesData.filter((p) => p.lunes > 0);
    } else {
      filteredList = planetesData.filter((p) => p.type === typeMapping[valeur]);
    }

    renderPlanetes(filteredList);
  });