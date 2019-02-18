
 let btnLogOut = document.getElementById('logout-form');
  let userName = document.getElementById('userName');userName.addEventListener("click", ()=>{
  
  if(btnLogOut.classList.contains("d-none")){
      btnLogOut.classList.remove("d-none");
      btnLogOut.classList.toggle("show");
  }else{
      btnLogOut.classList.remove("show");
      btnLogOut.classList.toggle("d-none");
  }
});

// let btnAct = document.getElementById("linkActividades");
// let ulAct = document.getElementById("ulActividades");

// btnAct.addEventListener("click",()=>{
 
//     if(ulAct.classList.contains("d-none")){
//       ulAct.classList.remove("d-none");
//       ulAct.classList.toggle("actividades-list");
//     }
// })



// window.addEventListener("click", e =>{
//   if(e.target != ulAct || e.target.parentNode != ulAct ){
//     // ulAct.classList.remove("actividades-list");
//     ulAct.classList.toggle("d-none");
//   }
// })


















// let select = document.getElementById("profile");

//   select.addEventListener("change",()=>{
//     let value = select[select.selectedIndex].value;
//     if(value == "administrador"){
//       let btnHide = document.getElementById("is_admin");
//       btnHide.value = true;
//       console.log(btnHide.value);
//     }else{
//       let btnHide = document.getElementById("is_admin");
//       btnHide.value = false;
//       console.log(btnHide.value);
//     }

// });

// logout btn 
  




