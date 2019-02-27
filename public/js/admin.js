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


