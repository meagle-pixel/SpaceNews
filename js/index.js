// ********** FORMULAIRE **********

const form = document.querySelector("form");

//  Vérifiez que le formulaire existe avant d'ajouter l'événement
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
  } else {
    formIcon.src = "images/traverser.png";
    formIcon.alt = "logo erreur";
  }

  formMessage.style.display = "flex";

  setTimeout(() => {
    formMessage.style.display = "none";
  }, 3000);
}

// page 4 Systeme solaire

const url = "http://127.0.0.1:5500/js/data/planetes.json";
const containerS = document.getElementById("planetes-system");
const info = document.getElementById("info-planete");
const filtre = document.getElementById("filtre-planetes");
let planetesData = [];

// filtre.addEventListener("change", (e)=> {
//   let filtrerValue = filtre.value;

//   let filtrerplanet = planetesData.filter((p) => {
//     if (filtrerValue === "all") return true;
//     if (filtrerValue === "tellurique") return p.type.toLowerCase().includes("tellurique");
//     if (filtrerValue === "gazeuse") return p.type.toLowerCase().includes("gazeuse");
//     if (filtrerValue === "glace") return p.type.toLowerCase().includes("glace");
//     if (filtrerValue === "lunes") return p.lunes > 0;
//   });

//   containerS.innerHTML = "";  // La je vide le conteneur



if (containerS) {
  async function afficherPlanetes() {
    try {
      const response = await fetch(url);
      const data = await response.json();
      planetesData = data.planetes;

      data.planetes.forEach((p) => {
        const article = document.createElement("article");
        article.classList.add("art");

        article.innerHTML = `
          <div class="planet-img">
            <img src="${p.img}" alt="${p.nom}">
          </div>
        `;

        //  CLIC SUR LA PLANÈTE
        article.addEventListener("click", () => {
          info.innerHTML = `
           <button id="close-info" style="position: absolute; top: 10px; right: 15px; background: none; border: none; color: #ff9500; font-size: 30px; cursor: pointer; font-weight: bold;">&times;</button>
            <h2>${p.nom}</h2>
            <p><strong>Type :</strong> ${p.type}</p>
            <p>Diamètre : ${p.diametre_km.toLocaleString("fr-FR")} km</p>
            <p>Masse : ${p.masse_kg} km</p>
            <p>Distance Soleil : ${p.distance_au_soleil_km.toLocaleString(
              "fr-FR"
            )} km</p>
            <p>Lune(s) : ${p.lunes}</p>
          `;

          const closeBtn = document.getElementById("close-info");
          closeBtn.addEventListener("click", (e) => {
            if (e.target.id === "close-info") {
              info.innerHTML = "";
            }
          });
        });

        containerS.appendChild(article);
      });
    } catch (error) {
      console.error("Erreur lors du chargement :", error);
    }
  }

  afficherPlanetes();
}
