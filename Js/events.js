
let div_comment = document.querySelectorAll('#comment_events');
let logo_comment = document.querySelectorAll('#logo_comment');
let textarea_comment = document.querySelectorAll('#input_comment');
let div_input = document.querySelectorAll('#div_input');
let heart = document.querySelectorAll('#coeur');
let nbre_commentaire = document.querySelectorAll('#nbre_comments');
console.log(div_input);
console.log(logo_comment);

for(let a=0; a<logo_comment.length; a++){
  logo_comment[a].addEventListener("click", function(){
    display_div_input(div_input[a]);
  });
}
// for(let i=0; i<textarea_comment.length; i++){
//   textarea_comment[i].addEventListener("input", function(){
//     display_div_comment(div_comment[i]);
//   });
// }
function display_div_input(div_input){
  if(div_input.style.display == "none"){
    div_input.style.display = "block";
  }
  else{
    div_input.style.display="none";
  }
}
// function display_div_comment(div_comment){
//   div_comment.style.display = "block";
// }
// Sélectionnez tous les formulaires de commentaire
let btnCommentForms = document.querySelectorAll('#btn-comment-form');
// console.log(commentForms);

// Parcourez chaque formulaire de commentaire et ajoutez un écouteur d'événements
for (let i = 0; i < btnCommentForms.length; i++) {
  btnCommentForms[i].addEventListener('click',function(){
    console.log('non');
    display_div_comment(div_comment[i]);
  })
}
for (let k = 0; k < nbre_commentaire.length; k++) {
  nbre_commentaire[k].addEventListener('click',function(){
    console.log('nonssd');
    display_div_comment(div_comment[k]);
  })
}

function display_div_comment(div_comment){
  if(div_comment.style.display == "block"){
    console.log('oui');
    div_comment.style.display = "none";
    // event.preventDefault(); 
  }
  else{
    div_comment.style.display="block";
  }
}



