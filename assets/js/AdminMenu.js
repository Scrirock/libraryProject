export class AdminMenu {

    static showMenu() {
        let menu = document.querySelector('.burger');
        let clickIcon = document.querySelector('#burgerIcon');
        let flag = 1;

        clickIcon.addEventListener('click', function () {
            if (flag) {
                menu.style.width = '20rem';
                flag = 0;
            }
            else {
                menu.style.width = '0';
                flag = 1;
            }
        });
    }

    static showSubMenu() {
        let subMenu = document.querySelectorAll('.subMenu');

        for (let i = 0; i < subMenu.length; i++) {
            subMenu[i].addEventListener('mouseenter', function (e) {
                e.target.style.height = '14rem';
            })
            subMenu[i].addEventListener('mouseleave', function (e) {
                e.target.style.height = '6rem'
            })
        }
    }
}