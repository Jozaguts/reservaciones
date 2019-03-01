const registerModal = document.getElementById("registerModal");
const userEditModal = document.getElementById("userEditModal");
const addUser = document.getElementById("addUser");
const editUser = document.getElementById("editUser");
const closeModal =document.getElementById("closeModal");
const closeModalEdit =document.getElementById("closeModalEdit");
//btn add user
addUser.addEventListener('click',(e)=>{
    e.preventDefault();
    if(registerModal.classList.contains("d-none")){
        registerModal.classList.remove("d-none")
        registerModal.classList.toggle("showModal");
    }
     
})
//btn edit user
function showEditModal(e){
    if(userEditModal.classList.contains("d-none")){
        userEditModal.classList.remove("d-none")
        userEditModal.classList.toggle("showModal");
    }

}

closeModal.addEventListener('click',(e)=>{
  e.preventDefault();
  if(closeModal.parentNode.classList.contains("showModal")){
    closeModal.parentNode.classList.remove("showModal")
    closeModal.parentNode.classList.toggle("d-none");
  }
     
})
//close modal edit user
closeModalEdit.addEventListener('click',(e)=>{
  e.preventDefault();
  if(closeModalEdit.parentNode.classList.contains("showModal")){
    closeModalEdit.parentNode.classList.remove("showModal")
    closeModalEdit.parentNode.classList.toggle("d-none");
  }
     
})
closeModal.addEventListener('click',(e)=>{
  if(userEditModal.classList.contains("userEditModal")){
      userEditModal.classList.remove("userEditModal")
      userEditModal.classList.add("d-none");
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