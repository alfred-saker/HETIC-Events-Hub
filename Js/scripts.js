const imageInput = document.querySelector("#image");
const imagePreview = document.querySelector("#preview");

if (imageInput) {
  imageInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.addEventListener("load", function () {
        imagePreview.setAttribute("src", this.result);
        imagePreview.style.display = "block";
      });
      reader.readAsDataURL(file);
    }
  });
}

// let menu_Burger = document.querySelector("#menu_Burger");
// let menuLink = document.querySelector("#menuLink");

// menu_Burger.addEventListener("click", () => {
//   if (menuLink.style.display === "block") {
//     menuLink.style.display = "none";
//   } else {
//     menuLink.style.display = "block";
//   }
// });

let name_user = document.querySelector("#nom_user_update");
let prenom_user = document.querySelector("#prenom_user_update");
let descrip = document.querySelector("#description_update");
let btn_update1 = document.querySelector("#update2");

name_user.addEventListener("input", check_value1);
prenom_user.addEventListener("input", check_value1);
descrip.addEventListener("input", check_value1);

let email = document.querySelector("#email_update");
let mdp = document.querySelector("#mdp_update");
let btn_update2 = document.querySelector("#update3");

email.addEventListener("input", check_value2);
mdp.addEventListener("input", check_value2);

function check_value1() {
  if ((name_user.value.length > 0 && prenom_user.value.length > 0) || descrip.value.length > 0) {
    btn_update1.disabled = false;
    console.log(btn_update1.disabled);
  } else {
    btn_update1.disabled = true;
  }
}

function check_value2() {
  if (email.value.length > 0 && mdp.value.length > 0) {
    btn_update2.disabled = false;
  } else {
    btn_update2.disabled = true;
  }
}

var image = document.querySelector("#image_events");
var previewPicture = function (e) {
  const [picture] = e.files;
  if (picture) {
    image.src = URL.createObjectURL(picture);
  }
};



