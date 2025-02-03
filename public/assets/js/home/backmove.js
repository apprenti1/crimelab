
function backmove() {
    if (window.scrollY > window.innerHeight / 6 && (window.innerWidth * 0.1)+window.scrollY-(window.innerHeight / 6)<window.innerWidth*0.5 && window.innerWidth > 1040) {
        document.getElementById('background').style.left = 'calc(10% + '+(window.scrollY-(window.innerHeight / 6))+'px)';
    }
    else if ((window.innerWidth * 0.1)+window.scrollY-(window.innerHeight / 6) >= window.innerWidth*0.5){
        document.getElementById('background').style.left = '50%';
    }
    else {
        document.getElementById('background').style = '';
    }
}
window.addEventListener('load', () => {backmove();});
window.addEventListener("resize", ()=>{backmove();});
addEventListener('scroll', () => {backmove(); console.log(document.getElementById('boutique').scrollY);});