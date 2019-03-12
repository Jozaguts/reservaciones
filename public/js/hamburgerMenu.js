const btnMenu = document.getElementById("btnMenu");
const hmContanier = document.getElementById('hmContanier');

// window.addEventListener('click',(e)=>{
//   let toggleStatus = 1;

//   function toggleMenu(){
//     if(toggleStatus==1){
//       if(e.target != hmContanier && e.target.parentNode != hmContanier){
//         hmContanier.classList.remove("d-none");
//             hmContanier.classList.add("show");
//             toggleStatus = 0;
//       }else{
//         if(toggleStatus ==0){
//           hmContanier.classList.remove("show");
//           hmContanier.classList.add("d-none");
//           toggleStatus=1;
//         }
//       }
  
//     }

//   }

  
// })

window.addEventListener('click', function(e){   
    if (document.getElementById('btnMenu').contains(e.target)){

      let toggleStatus = 1;
      function toggleMenu (){
        if(toggleStatus==1){
      
          hmContanier.classList.remove("d-none");
          hmContanier.classList.add("show");
          toggleStatus = 0;
        }else if(toggleStatus==0){
          hmContanier.classList.remove("show");
          hmContanier.classList.add("d-none");
          toggleStatus=1;
        }
      }
      toggleMenu();
      // Clicked in box
    } else{
      if( hmContanier.classList.contains("show")){
        hmContanier.classList.remove("show");
        hmContanier.classList.toggle("d-none");
      } 
    }
  });