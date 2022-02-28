import './styles/app.scss';
import {CategoryAnimation} from "./js/CategoryAnimation";
import {AdminMenu} from "./js/AdminMenu";

let box = document.querySelectorAll('.box');

for (let i = 0; i < box.length; i++) {
    box[i].addEventListener('click', ()=>{
        let animate = new CategoryAnimation(box[i]);
        if (box[i].style.height === '30rem'){
            setTimeout(function (){animate.appear()}, 500);
            animate.smaller();
            setTimeout(function (){animate.initial()}, 500);
        }
        else {
            animate.disappear();
            setTimeout(function (){animate.greater()}, 500);
            animate.center();
        }
    })
}

AdminMenu.showMenu();
AdminMenu.showSubMenu();