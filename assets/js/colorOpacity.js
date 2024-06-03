/* Les variables */
/* function colorOpacity() {
    console.log('in'); */
    
    let opacity = document.querySelector('.opacityRange');
    let bulb = document.querySelector('.bulb');
    let color = document.querySelector('.colorWheel');
    let switchOnOff = document.querySelector('.switch input');
              
    
    bulb.style.backgroundColor = color.value;
    bulb.style.opacity = opacity.value/100;

   /*  if (bulb.style.backgroundColor !== "#FFFFFF" || bulb.style.opacity > 0) {
        switchOnOff.checked;
    } else {
        switchOnOff.
    }
     */
    
    
    /* Les fonctions */
    function changeOpacity() {
        bulb.style.opacity = opacity.value/100;
    }
    
    function changeColor() {
        bulb.style.backgroundColor = color.value;
    }
    
    function flipSwitch() {
        
        if (switchOnOff.checked) {
            bulb.style.backgroundColor = color.value;
            bulb.style.opacity = opacity.value/100;
        } else {
            bulb.style.opacity = 0;
            opacity.style.backgroundColor = "#FFFFFF"; 
        }   
    }
    
    
    /* Gestionnaire d'événement */
    opacity.addEventListener('input', changeOpacity);
    color.addEventListener('input', changeColor);
    switchOnOff.addEventListener('input', flipSwitch);
    
/* }

export default colorOpacity; */