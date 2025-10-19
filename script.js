document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contactForm");
  const error = document.getElementById("clientError");
  if (!form) return;

  form.addEventListener("submit", (e) => {
    error.hidden = true;
    const data = new FormData(form);
    const required = ["full_name","email","subject","message"];
    for (const key of required) {
      const v = (data.get(key) || "").toString().trim();
      if (!v) {
        e.preventDefault();
        error.textContent = "Por favor, completa todos los campos obligatorios (*).";
        error.hidden = false;
        return;
      }
    }
    // email simple check
    const email = (data.get("email") || "").toString().trim();
    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
      e.preventDefault();
      error.textContent = "Ingresa un correo válido.";
      error.hidden = false;
      return;
    }
  });
});
