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

let menu_Burger = document.getElementById("menu_Burger");
let menuLink = document.getElementById("menuLink");

menu_Burger.addEventListener('click', () => {
    console.log(menuLink.style.display);
    if (menuLink.style.display === "block") { 
        console.log("hello");
        menuLink.style.display = "none";
    } else { 
        console.log("hellogf");
        menuLink.style.display = "block";
    } 
})

const carousel = document.getElementsByClassName(".carousel");
const container = carousel.getElementsByClassName(".carousel-container");
const prevBtn = carousel.getElementsByClassName(".prev");
const nextBtn = carousel.getElementsByClassName(".next");
const items = carousel.getElementsByClassName(".carousel-item");
const itemCount = items.length;
const itemWidth = carousel.offsetWidth;
let currentIndex = 0;
let interval;

function init() {
  container.style.width = `${itemCount * itemWidth}px`;
  items.forEach((item) => {
    item.style.width = `${itemWidth}px`;
  });
  prevBtn.addEventListener("click", () => {
    currentIndex--;
    if (currentIndex < 0) {
      currentIndex = itemCount - 1;
    }
    slideTo(currentIndex);
  });
  nextBtn.addEventListener("click", () => {
    currentIndex++;
    if (currentIndex >= itemCount) {
      currentIndex = 0;
    }
    slideTo(currentIndex);
  });
  startSlide();
}

function startSlide() {
  interval = setInterval(() => {
    currentIndex++;
    if (currentIndex >= itemCount) {
      currentIndex = 0;
    }
    slideTo(currentIndex);
  }, 3000);
}

function stopSlide() {
  clearInterval(interval);
}

function slideTo(index) {
  container.style.transform = `translateX(-${index * itemWidth}px)`;
  currentIndex = index;
}

carousel.addEventListener("mouseenter", () => {
  stopSlide();
});

carousel.addEventListener("mouseleave", () => {
  startSlide();
});

init();
