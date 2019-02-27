const registerModal = document.getElementById("registerModal");
const addUser = document.getElementById("addUser");
const closeModal =document.getElementById("closeModal");

addUser.addEventListener('click',(e)=>{
    e.preventDefault();
    if(registerModal.classList.contains("d-none")){
        registerModal.classList.remove("d-none")
        registerModal.classList.toggle("registerModal");
    }
     
})
closeModal.addEventListener('click',(e)=>{
   
    if(registerModal.classList.contains("registerModal")){
        registerModal.classList.remove("registerModal")
        registerModal.classList.add("d-none");
    }
     
})


//btn-Logout

window.addEventListener('click', function(e){   
    if (document.getElementById('btnUserName').contains(e.target)){
  
      let toggleStatus = 1;
      function toggleMenu (){
        if(toggleStatus==1){
      
          btnLogOut.classList.remove("d-none");
          btnLogOut.classList.add("show");
          toggleStatus = 0;
        }else if(toggleStatus==0){
          btnLogOut.classList.remove("show");
          btnLogOut.classList.add("d-none");
          toggleStatus=1;
        }
      }
      toggleMenu();
      // Clicked in box
    } else{
      if( btnLogOut.classList.contains("show")){
        btnLogOut.classList.remove("show");
        btnLogOut.classList.toggle("d-none");
      } 
    }
  });