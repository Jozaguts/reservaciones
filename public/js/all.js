
let select = document.getElementById("profile");

  select.addEventListener("change",()=>{
    let value = select[select.selectedIndex].value;
    if(value == "administrador"){
      let btnHide = document.getElementById("is_admin");
      btnHide.value = true;
      console.log(btnHide.value);
    }else{
      let btnHide = document.getElementById("is_admin");
      btnHide.value = false;
      console.log(btnHide.value);
    }

});







// getValue.addEventListener("onchange", showi(){
  
//   // let value = profile[profile.selectedIndex].text;
 
// });


