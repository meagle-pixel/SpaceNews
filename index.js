const planets = [
  "Mercury",
  "Venus",
  "Earth",
  "Mars",
  "Jupiter",
  "Saturn",
  "Uranus",
  "Neptune",
];

planets.forEach((name) => {
  fetch(`https://api.api-ninjas.com/v1/planets?name=${name}`, {
    headers: {
      "X-Api-Key": "AR8OsTVJdP3da+XsLsRQ1A==dS0QmDvtepXP5xO2",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);

      const planet = data[0];
      const container = document.getElementById("planet-info");
      container.innerHTML += `
            <h2>${planet.name}</h2>
            <p>Mass: ${planet.mass}</p>
            <p>Radius: ${planet.radius}</p>
            <p>Period: ${planet.period}</p>
            <p>Semi-major axis: ${planet.semi_major_axis}</p>
            <hr>
        `;
    });
});

// FORMULAIRE

const form = document.querySelector("form");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const lastName = document.getElementById("lastName").value.trim();
  const firstName = document.getElementById("firstName").value.trim();
  const email = document.getElementById("email").value.trim();
  const mobile = document.getElementById("mobile").value.trim();
  const message = document.getElementById("textarea").value.trim();

  if (!lastName || !firstName || !email || !message) {
    alert("Veuillez remplir tous les champs obligatoires !");
    return;
  }

  console.log({
    lastName, firstName, email, mobile, message
  });

  alert("Formulaire complété avec succés !")
  form.reset ();
});
getElementById