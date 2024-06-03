// import defaultExport from "./colorOpacity.js";

/* Les variables */
let myPlaces = document.querySelector('.myPlaces');
let myBulbs = document.querySelector('.myBulbs');
let myMoods = document.querySelector('.myMoods');
let mySchedules = document.querySelector('.mySchedules');
let centralDashboard = document.querySelector('#centralDashboard');
const API_URL = 'https://127.0.0.1:8000/';

/* Les fonctions */

function loadMyBulbs() {

    window.fetch(API_URL + 'my/bulbs')
    .then(function(httpResponse)
    {
        return httpResponse.text();   
    })
    .then(function(results) // results = les données JSON, grâce au httpResponse.json() ci-dessus
    {
        centralDashboard.innerHTML = results;

        
    });
}




/* Les gestionnaires d'événements */

myBulbs.addEventListener('click', loadMyBulbs);
