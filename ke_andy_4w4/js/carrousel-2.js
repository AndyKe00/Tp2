(function(){
    let carrousel = document.querySelectorAll('.carrousel-2');
    let ctrlCarrousel = document.querySelectorAll('.ctrl-carrousel');
    let noCtrlCarrousel = 0;
    for (const elmCarrousel of carrousel)
    {
        let bout  = ctrlCarrousel[noCtrlCarrousel].querySelectorAll('.ctrl-carrousel input');
        noCtrlCarrousel = noCtrlCarrousel + 1;
        let noBouton = 0;
        bout[0].checked = true;
        for (const bt of bout){
            bt.value = noBouton++;
            bt.addEventListener('mousedown', function(){
                elmCarrousel.style.transform = "translateX(" + (-this.value*100) + "vw)"
            })
        }

    }
}())