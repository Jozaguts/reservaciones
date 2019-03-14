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
//mostrar modal agragar unidad

let btnAddTipoEU = document.getElementById('btnAddTipoEU');
let tipoEUModal = document.getElementById('tipoEUModal');
btnAddTipoEU.addEventListener('click',()=>{
let toggleStatus = 0;
if(toggleStatus==0){
    
    if(tipoEUModal.classList.contains('d-none')){

        tipoEUModal.classList.remove('d-none')
        tipoEUModal.classList.add('showModal')
        toggleStatus=1;
        
    }
}else{
   
    if(toggleStatus=1){
        if(!tipoEUModal.classList.contains('d-none')){
            tipoEUModal.classList.add('d-none')
            toggleStatus=0;
        }
    }
}
 
})

//cerrar modal agregar unidad
let closeModal = document.getElementById('closeModal');

closeModal.addEventListener('click',(e)=>{
    if(e.target == closeModal){
        if(tipoEUModal.classList.contains('showModal')){
            tipoEUModal.classList.remove('showModal')
            tipoEUModal.classList.add('d-none')
        }
    }
})

//////////////////////////////////////// ajax ////////////////////////////////////////////////////

