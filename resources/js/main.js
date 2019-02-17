
let userName = document.getElementById('userName').addEventListener("click", ()=>{
  let btnLogOut = document.getElementById('logout-form');
  if(btnLogOut.classList.contains("d-none")){
    btnLogOut.classList.remove("d-none");
    btnLogOut.classList.toggle("show");
  }else{
    btnLogOut.classList.remove("show");
    btnLogOut.classList.toggle("d-none");
  }
 
});






















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
  




