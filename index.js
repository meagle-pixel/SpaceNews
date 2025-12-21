
// const planetes = ["mercury","venus","earth","mars","jupiter","saturn","uranus","neptune"];


// async function afficherPlanetes() {
//   const apiUrl = "https://api.api-ninjas.com/v1/planets?name=earth";
//   const apiKey = "AR8OsTVJdP3da+XsLsRQ1A==dS0QmDvtepXP5xO2";

// try {
//   const response = await fetch(apiUrl, {
//     headers: { 
//       'X-Api-Key': apiKey
//   }
//  });

//   const data = await response.json();
//   console.log("Planètes reçues :", data);

//   // Dans le but de l'afficher dans le HTML

//   const container = document.getElementById("planet-info");

//   data.forEach(planete => {
//     const p = document.createElement("p");
//     p.textContent = planete.name;
//     container.appendChild(p);
//   });

// } catch (error) {
//   console.error("Erreur", error);
//   alert("Impossible de récupérer les données");
// }
// }
// afficherPlanetes();

// ********** FORMULAIRE **********

const form = document.querySelector("form");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const lastName = document.getElementById("lastName").value.trim();
  const firstName = document.getElementById("firstName").value.trim();
  const email = document.getElementById("email").value.trim();
  const mobile = document.getElementById("mobile").value.trim();
  const message = document.getElementById("textarea").value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const mobilePattern = /^[0-9]{10}$/;

  if (!lastName || !firstName || !email || !message) {
    alert("Veuillez remplir tous les champs obligatoires !");
    return;
  }

  if (!emailPattern.test(email)) {
    alert("Veuillez enter une adresse mail valide");
    return;
  }

  if (mobile && !mobilePattern.test(mobile)) {
    alert("Votre numéro de téléphone doit contenir des chiffres (1,2,3...)")
    return;
  }

  alert("Formulaire complété avec succés !");
  form.reset();
});
