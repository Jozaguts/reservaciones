const btnMenu = document.getElementById("btnMenu");
const spanBtnMenu = document.getElementById('spanBtnMenu')
const hmContanier = document.getElementById('hmContanier');

// const hmitems = document.querySelectorAll('.')



// btnMenu.addEventListener('click',(e)=>{
//   let toggleStatus =1;
//   if(toggleStatus==1){
//     if(hmContanier.classList.contains('d-none')){
//       hmContanier.classList.remove('d-none')
//       hmContanier.classList.add('show')
      
//     }else
//     toggleStatus = 0;
//           if(toggleStatus==0){
//             if(hmContanier.classList.contains('show'))
//             {
//               hmContanier.classList.remove('show')
//               hmContanier.classList.add('d-none')
//               toggleStatus = 1;
//             }
//           }
//   }
// })

window.addEventListener('click',(e)=>{


  let toggleStatus =0; //cero es oculto
  if(toggleStatus ==0 && e.target == btnMenu || e.target == spanBtnMenu){
    if(hmContanier.classList.contains('d-none')){
      hmContanier.classList.remove('d-none')
      hmContanier.classList.add('show')
      
    }else
    toggleStatus = 1; //uno es mostrar
          if(toggleStatus==1){
            if(hmContanier.classList.contains('show'))
            {
              hmContanier.classList.remove('show')
              hmContanier.classList.add('d-none')
              toggleStatus = 0;
            }
          }
  }else{
    if(!e.target.classList.contains('hm-list__item')){
      if(hmContanier.classList.contains('show'))
      {
        hmContanier.classList.remove('show')
        hmContanier.classList.add('d-none')
        toggleStatus = 0;
      }
    }
  }

})


// window.addEventListener('click', function(e){   
//     if (document.getElementById('btnMenu').contains(e.target)){

//       let toggleStatus = 1;
//       function toggleMenu (){
//         if(toggleStatus==1){
      
//           hmContanier.classList.remove("d-none");
//           hmContanier.classList.add("show");
//           toggleStatus = 0;
//         }else if(toggleStatus==0){
//           hmContanier.classList.remove("show");
//           hmContanier.classList.add("d-none");
//           toggleStatus=1;
//         }
//       }
//       toggleMenu();
//       // Clicked in box
//     } else{
//       if( hmContanier.classList.contains("show")){
//         hmContanier.classList.remove("show");
//         hmContanier.classList.toggle("d-none");
//       } 
//     }
//   });