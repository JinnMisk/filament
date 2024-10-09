//*************************************//
//********* MOODS PICTURES ***********//
//************************************//

//Récupération des boutons 
let cosyBtn = document.querySelector('#cosyBtn');
let romanticBtn = document.querySelector('#romanticBtn');
let nightBtn = document.querySelector('#nightBtn');
let sleepTimeBtn = document.querySelector('#sleepTimeBtn');

//Récupération des images 
let cosyPic = document.querySelector('#cosyPic');
let romanticPic = document.querySelector('#romanticPic');
let nightPic = document.querySelector('#dayPic');
let sleepTimePic = document.querySelector('#sleepTimePic');

//Récupérer la valeur de l'opacité pour chaque image ; lui donner un nom et un valeur
let cosyPicOpacity = parseFloat(window.getComputedStyle(cosyPic).getPropertyValue('opacity')); 
cosyPicOpacity= 1;
let romanticPicOpacity = parseFloat(window.getComputedStyle(romanticPic).getPropertyValue('opacity')); 
romanticPicOpacity = 0;
let nightPicOpacity = parseFloat(window.getComputedStyle(nightPic).getPropertyValue('opacity')); 
nightPicOpacity = 0;
let sleepTimePicOpacity = parseFloat(window.getComputedStyle(sleepTimePic).getPropertyValue('opacity')); 
sleepTimePicOpacity = 0;

//Fonction servant à changer d'image en variant l'opacité
function switchMood(event) {

    //Condition pour savoir qu'elle image sera visible et lesquelles seront invisibles
    if (event.target.id == 'cosyBtn') {
        cosyPic.style.opacity = 1;
        romanticPic.style.opacity = 0;
        nightPic.style.opacity = 0;
        sleepTimePic.style.opacity = 0; 
        
    } else if (event.target.id == 'romanticBtn') {
        cosyPic.style.opacity = 0;
        romanticPic.style.opacity = 1;
        nightPic.style.opacity = 0;
        sleepTimePic.style.opacity = 0;
        
    } else if (event.target.id == 'nightBtn') {
        cosyPic.style.opacity = 0;
        romanticPic.style.opacity = 0;
        nightPic.style.opacity = 1;
        sleepTimePic.style.opacity = 0;
        
    } else if (event.target.id == 'sleepTimeBtn') {
        cosyPic.style.opacity = 0;
        romanticPic.style.opacity = 0;
        nightPic.style.opacity = 0;
        sleepTimePic.style.opacity = 1;
    }
}

//Événement clic se produisant sur les boutons pour changer d'image
cosyBtn.addEventListener('click', switchMood);
romanticBtn.addEventListener('click', switchMood);
nightBtn.addEventListener('click', switchMood);
sleepTimeBtn.addEventListener('click', switchMood);


