export class CategoryAnimation {

    constructor(target) {
        this.target = target
        this.box = document.querySelectorAll('.box');
        this.centerX = window.innerWidth/2;
        this.centerY = window.innerHeight/2;
        this.posX = target.offsetLeft + target.offsetWidth/2;
        this.posY = target.offsetTop + 150;
    }

    greater() {
        this.target.style.height = '30rem';
    }

    smaller() {
        this.target.style.height = '9rem';
    }

    center() {
        this.target.style.zIndex = '100';
        this.createHideBug();
        this.target.style.transform = 'translate('+(this.centerX-this.posX)+'px,'+(this.centerY-this.posY)+'px)';
    }

    initial() {
        this.target.style.transform = 'translate(0)';
        this.deleteHidBug();
        setTimeout(function (){this.target.style.zIndex = '0'}, 1000);
    }

    disappear() {
        for (let i = 0; i < this.box.length; i++) {
            if (this.box[i] !== this.target) {
                this.box[i].style.opacity = '0';
                this.box[i].style.cursor = 'initial';
            }
        }
    }

    appear() {
        for (let i = 0; i < this.box.length; i++) {
            this.box[i].style.opacity = '1';
            this.box[i].style.cursor = 'pointer';
        }
    }

    createHideBug() {
        let div = document.createElement('div');
        div.id = "fullScreen";
        document.body.append(div)
    }

    deleteHidBug() {
        let div = document.querySelector('#fullScreen');
        if (div) {
            div.remove();
        }
    }
}