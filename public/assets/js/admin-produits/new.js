let idFourniture = 0;
let idImage = 0;
const image = document.getElementById('image');
const canvas = document.getElementById('canvas');
let cropper;


function addFourniture() {
    let fournitures =  document.getElementById('fournitures');
    let element = 
    "<tr class=\"border-bottom border-black\" id=\"id"+idFourniture+"\">"+
    "        <input type=\"hidden\" name=\"fournitures-id[]\" value=\""+fournitures.value+"\">"+
    "        <input type=\"hidden\" name=\"fournitures-quantity[]\" value=\""+document.getElementById('fournitures-quantity').value+"\">"+
    "        <td class=\"text-primary\">"+fournitures.value+"</td>"+
    "        <td class=\"text-start\" style=\"padding: 0 20px;\">"+fournitures.selectedOptions[0].text+"</td>"+
    "        <td class=\"text-primary\">"+document.getElementById('fournitures-quantity').value+"</td>"+
    "        <td class=\"text-primary\">"+
    "            <button type=\"button\" onclick=\"delFourniture("+idFourniture+")\">del</button>"+
    "        </td>"+
    "</tr>";
    idFourniture+=1;
    
    document.getElementById('fournitures-container').insertAdjacentHTML('beforeend', element);
}
function delFourniture(todel) {
    document.querySelector("tr#id"+todel).remove();
}



document.getElementById('file-input').addEventListener('change', (event) => {
const file = event.target.files[0];
if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        image.src = e.target.result;
        document.querySelector('.crop-container').style.display = 'block';
        if (cropper) {
            cropper.destroy();
    }
    cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 1,
    });
    };
    reader.readAsDataURL(file);
}
});

document.getElementById('crop-button').addEventListener('click', () => {
    const croppedCanvas = cropper.getCroppedCanvas();
    const context = canvas.getContext('2d');
canvas.width = croppedCanvas.width;
canvas.height = croppedCanvas.height;
context.drawImage(croppedCanvas, 0, 0);

// Get the base64 value of the cropped image
const base64Image = canvas.toDataURL('image/png');
//console.log(base64Image);
document.querySelector('.crop-container').style.display = 'none';
document.getElementById('preview').children[0].src = base64Image;
document.getElementById('preview').style.display = "block";
});

function addImage() {
    let imagesEmplacement =  document.getElementById('images-emplacement');
    let element = 
    "<tr class=\"border-bottom border-black\" id=\"id"+idImage+"\">"+
    "        <input type=\"hidden\" name=\"images-emplacement[]\" value=\""+imagesEmplacement.value+"\">"+
    "        <input type=\"hidden\" name=\"images[]\" value=\""+document.getElementById('preview').children[0].src+"\">"+
    "        <td class=\"text-primary d-flex justify-content-center\">"+
    "           <div class=\"branding-container m-2\">"+
    "               <img src=\""+document.getElementById('preview').children[0].src+"\" alt=\"preview\" height=\"200\" width=\"200\">"+
    "               <img src=\""+document.getElementById('baseurl').innerHTML+"assets/img/icon.svg\" class=\""+((imagesEmplacement.value == 0)?"branding" : ((imagesEmplacement.value == 1)?"branding-right" : ((imagesEmplacement.value == 2)?"brending-top" : "branding-left")))+"\">"+
    "        </td>"+
    "        <td class=\"text-primary\">"+
    "            <button type=\"button\" onclick=\"delImage("+idImage+")\">del</button>"+
    "        </td>"+
    "</tr>";
    idImage+=1;
    
    document.getElementById('images-container').insertAdjacentHTML('beforeend', element);
}