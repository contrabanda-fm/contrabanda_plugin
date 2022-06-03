class GraellaNav{
    constructor(){
        this.tabs = [... document.getElementsByClassName('navigation__item--button')]
        this.table = document.getElementById('graella');
        this.init();
    }
    init = () => {
        this.tabs.forEach((element) => {
            element.addEventListener('click', () =>{
                const target = element.getAttribute('day-target');
                this.tabs.forEach((tab) => {
                    tab.classList.remove('active');
                });
                element.classList.toggle('active');
                this.table.className = ''
                this.table.classList.add('graella');
                this.table.classList.add(target);
            });
        });
    }
}

export {GraellaNav};