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

function showErrorOrSuccess(msg, type = "error") {
  const formMessage = document.getElementById("form-message");
  const formText = document.getElementById("formText");
  const formIcon = document.getElementById("form-icon");

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

const containerS = document.getElementById('planetes-system');
const info = document.getElementById('info-planete');

async function afficherPlanetes() {
  try {
    const response = await fetch("planetes.json");
    const planetes = await response.json();
  }
}