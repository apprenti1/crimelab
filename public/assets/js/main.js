const $root = $('html, body');
let scrollTop = false;

function scrollTo(anchor) {
    if (anchor.length) {
        $root.animate({scrollTop: $( anchor ).offset().top}, 800);
    }
}
function scrollUpdate() {
    const arrow = document.getElementById('scrolltoTop');
        if((window.scrollY || document.documentElement.scrollTop || document.body.scrollTop) > 200){
            if(!scrollTop){
                arrow.style.opacity = 1;
                scrollTop = true;
            }
        }
        else if(scrollTop){
            arrow.style.opacity = 0;
            scrollTop = false;
        }
}
function setMaxHeightBetween(element1, element2){
    element1.style.height = 'fit-content';
    element2.style.height = 'fit-content';
    element1.style.height = Math.max(element1.offsetHeight, element2.offsetHeight)+'px';
    element2.style.height = Math.max(element1.offsetHeight, element2.offsetHeight)+'px';
}

document.addEventListener("DOMContentLoaded", ()=>{

    document.querySelectorAll('a[target="_blank"]').forEach(element => {
        element.parentElement.remove();
    });

    $('a[href^="#"]').on('click', function (event) {
        event.preventDefault();
        scrollTo($.attr(this, 'href'));
        history.pushState(null, null, $.attr(this, 'href'));
    });

    scrollUpdate();
    
    window.addEventListener('DOMContentLoaded', () => {if(window.location.hash){
        setTimeout(()=>{scrollTo(window.location.hash);}, 500);
    }});
    document.getElementById('scrolltoTop').addEventListener('click', ()=>{
        if(scrollTop){scrollTo('#accueil')}
        history.pushState(null, null, '#accueil');
    });
    document.addEventListener('scroll', scrollUpdate);
    
    let sameheihtelements = document.getElementsByClassName('sameheight')
    setTimeout(()=>{
        if (sameheihtelements.length%2 == 0) {
            for (let index = 0; index < (sameheihtelements.length/2); index++) {
                console.log("heheee");
                setMaxHeightBetween(sameheihtelements[index*2], sameheihtelements[index*2 + 1]);
                window.addEventListener('resize',()=>{setMaxHeightBetween(sameheihtelements[index*2], sameheihtelements[index*2 + 1]);});
            }
        }
    }, 500);
    
});