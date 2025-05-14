document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      const nom = btn.dataset.nom;
      document.getElementById('deleteText').textContent = `Voulez-vous vraiment supprimer ${nom} ?`;
      document.getElementById('deleteUserId').value = id;
      document.getElementById('deleteModal').classList.remove('hidden');
    });
  });
  
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('editUserId').value = btn.dataset.id;
      document.getElementById('editNom').value = btn.dataset.nom;
      document.getElementById('editPrenom').value = btn.dataset.prenom;
      document.getElementById('editEmail').value = btn.dataset.email;
      document.getElementById('editAdresse').value = btn.dataset.adresse;
      document.getElementById('editTelephone').value = btn.dataset.telephone;
      document.getElementById('editModal').classList.remove('hidden');
    });
  });
  
  function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
  }
  
  function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
  }
  