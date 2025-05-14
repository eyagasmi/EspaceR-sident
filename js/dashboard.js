window.addEventListener("DOMContentLoaded", () => {
    // Graphe satisfaction
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    new Chart(satisfactionCtx, {
      type: 'doughnut',
      data: {
        labels: ['Satisfaits', 'Non satisfaits'],
        datasets: [{
          label: 'Taux satisfaction',
          data: [87, 13],
          backgroundColor: ['#4CAF50', '#FF5252'],
          borderWidth: 1
        }]
      }
    });
  
    // Graphe villas
    const villaCtx = document.getElementById('villaChart').getContext('2d');
    new Chart(villaCtx, {
      type: 'bar',
      data: {
        labels: ['Villas louées', 'Villas non louées'],
        datasets: [{
          label: 'Villas',
          data: [38, 12],
          backgroundColor: ['#2196F3', '#FFC107']
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
  