

// Js chat messagerie


let section_discussion = document.querySelector("#section-discussion");
let section_friend_list = document.querySelector("#section-friend-list");
let section_chat = document.querySelector("#section-chat");
let icon_click_etud = document.querySelector("#list-etudiant");
let icon_click_msg = document.querySelector("#list-msg");

icon_click_etud.addEventListener("click", display_etudiant);
icon_click_msg.addEventListener("click", display_chat_discussion);

function display_etudiant() {
  if (
    section_chat.style.display === "block" ||
    section_discussion.style.display === "block" ||
    section_friend_list.style.display === "none"
  ) {
    section_chat.style.display = "none";
    section_discussion.style.display = "none";
    section_friend_list.style.display = "block";
  }
}
function display_chat_discussion() {
  if (
    section_chat.style.display === "none" &&
    section_discussion.style.display === "none"
  ) {
    section_chat.style.display = "block";
    section_discussion.style.display = "block";
    section_friend_list.style.display = "none";
  }
}

let bloc_pmd = document.querySelector("#section_PMD");
let bloc_cto = document.querySelector("#section_CTO");
let bloc_md = document.querySelector("#section_MD");
let bloc_pm = document.querySelector("#section_PM");
let bloc_cyber = document.querySelector("#section_CYBER");
let bloc_bd = document.querySelector("#section_BD");
let bloc_b3d = document.querySelector("#section_B3D");
let bloc_data = document.querySelector("#section_DATA");
let bloc_ux = document.querySelector("#section_UX");

let btn_title1 = document.querySelector("#btn-title1");
let btn_title2 = document.querySelector("#btn-title2");
let btn_title3 = document.querySelector("#btn-title3");
let btn_title4 = document.querySelector("#btn-title4");
let btn_title5 = document.querySelector("#btn-title5");
let btn_title6 = document.querySelector("#btn-title6");
let btn_title7 = document.querySelector("#btn-title7");
let btn_title8 = document.querySelector("#btn-title8");
let btn_title9 = document.querySelector("#btn-title9");




btn_title1.addEventListener("click",display_section1);
btn_title2.addEventListener("click",display_section2);
btn_title3.addEventListener("click",display_section3);
btn_title4.addEventListener("click",display_section4);
btn_title5.addEventListener("click",display_section5);
btn_title6.addEventListener("click",display_section6);
btn_title7.addEventListener("click",display_section7);
btn_title8.addEventListener("click",display_section8);
btn_title9.addEventListener("click",display_section9);

function display_section1() {
  if(bloc_pmd.style.display === "none"){
    console.log("hello world");
    bloc_pmd.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_pmd.style.display = "none";
  }
}
function display_section2() {
  if(bloc_cto.style.display === "none"){
    console.log("hello world");
    bloc_cto.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_cto.style.display = "none";
  }
}
function display_section3() {
  if(bloc_md.style.display === "none"){
    console.log("hello world");
    bloc_md.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_md.style.display = "none";
  }
}
function display_section4() {
  if(bloc_pm.style.display === "none"){
    console.log("hello world");
    bloc_pm.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_pm.style.display = "none";
  }
}
function display_section5() {
  if(bloc_cyber.style.display === "none"){
    console.log("hello world");
    bloc_cyber.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_cyber.style.display = "none";
  }
}
function display_section6() {
  if(bloc_bd.style.display === "none"){
    console.log("hello world");
    bloc_bd.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_bd.style.display = "none";
  }
}
function display_section7() {
  if(bloc_b3d.style.display === "none"){
    console.log("hello world");
    bloc_b3d.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_b3d.style.display = "none";
  }
}
function display_section8() {
  if(bloc_data.style.display === "none"){
    console.log("hello world");
    bloc_data.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_data.style.display = "none";
  }
}
function display_section9() {
  if(bloc_ux.style.display === "none"){
    console.log("hello world");
    bloc_ux.style.display = "block";
  }else{
    console.log("hello worldss");
    bloc_ux.style.display = "none";
  }
}


