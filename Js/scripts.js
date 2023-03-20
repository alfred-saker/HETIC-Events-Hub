const imageInput = document.getElementById('image');
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

