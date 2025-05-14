// js/register.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const nom = document.querySelector('input[name="nom"]');
    const email = document.querySelector('input[name="email"]');
    const maison = document.querySelector('input[name="code_maison"]');
    const pass = document.querySelector('input[name="mot_de_passe"]');
    const confirm = document.querySelector('input[name="mot_de_passe_confirm"]');
  
    form.addEventListener('submit', (e) => {
      let errors = [];
  
      if (nom.value.trim().length < 2) errors.push("Nom trop court.");
      if (!email.value.includes('@')) errors.push("Email invalide.");
      if (maison.value.trim() === "") errors.push("Code maison requis.");
      if (pass.value.length < 6) errors.push("Mot de passe trop court.");
      if (pass.value !== confirm.value) errors.push("Les mots de passe ne correspondent pas.");
  
      if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
      }
    });
  });
  