document.addEventListener("DOMContentLoaded", function() {
    var welcomeText = document.getElementById("welcome-text");
    welcomeText.style.color = "#007bff"; 

    var myIot = document.getElementById('myIot');

    // Ajoutez la classe 'anime' après un délai de 1 seconde
    setTimeout(function() {
        myIot.classList.add('anime');
    }, 1000);

});