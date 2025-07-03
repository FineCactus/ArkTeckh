document.addEventListener("DOMContentLoaded", function () {
    const bookButtons = document.querySelectorAll(".book-btn");
  
    bookButtons.forEach(btn => {
      btn.addEventListener("click", function () {
        alert("Appointment booked for this project!");
      });
    });
  });
  