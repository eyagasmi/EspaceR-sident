// js/index.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const email = document.querySelector('input[name="email"]');
    const pass = document.querySelector('input[name="mot_de_passe"]');
  
    form.addEventListener('submit', (e) => {
      let errors = [];
  
      if (!email.value.includes('@')) {
        errors.push("Email invalide.");
      }
  
      if (pass.value.length < 6) {
        errors.push("Mot de passe trop court (min 6 caractères).");
      }
  
      if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
      }
    });
  });
  