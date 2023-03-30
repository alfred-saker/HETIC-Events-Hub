const imageInput = document.getElementById('image_profil');
const imagePreview = document.getElementById('preview');

imageInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener('load', function() {
      imagePreview.setAttribute('src', this.result);
      imagePreview.style.display = 'block';
    });
    reader.readAsDataURL(file);
  }
});

let btn1 = document.getElementById('btn_display');
let btn2 = document.getElementById('btn_hidden');
let section = document.getElementById('UpdateProfil');

btn1.addEventListener('click', () => {
  section.style.display = 'block'; // Affichage de la section
});
btn2.addEventListener('click', () => {
  section.style.display = 'none'; // Masquage de la section
});

let menu_Burger = document.getElementById("menu_Burger");
let menuLink = document.getElementById("menuLink");

menu_Burger.addEventListener('click', () => {
  if(menuLink.style.display === "block") { 
    menuLink.style.display = "none";
  } 
  else{ 
    menuLink.style.display = "block";
  } 
})

let abonner = document.getElementById("suscribe");
console.log(abonner);
let value = abonner.href;
