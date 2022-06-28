let toggle = document.querySelector('.toggle');
let navigator = document.querySelector('.vertical-navigation');
let main    = document.querySelector('.main');



function zoom() {
    document.body.style.zoom = "80%"
}
   //navigator

toggle.onclick= function (){
navigator.classList.toggle('active');
   }
   //add hoverd calss in selected div list iteams
let list = document.querySelectorAll('.vertical-navigation li');

function activeLink(){
    list.forEach( (element) =>
     element.classList.remove('hovered'));
    this.classList.add('hovered');
 }
 list.forEach((iteam)=>iteam.addEventListener('mouseover' ,activeLink));


 function alretSuccessAdd (msg){
    alert(msg);
 }

 function handelAlretMassege (){

 }
