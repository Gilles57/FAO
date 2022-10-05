window.onload = (event) => {
    console.log('La page est complètement chargée');
    console.log(screen.width);
    if (screen.width > 700) {
        const list = document.getElementsByClassName('projets');
        for (let item of list) {
            item.style.height = '330px';
        }
    }
    ;
};
