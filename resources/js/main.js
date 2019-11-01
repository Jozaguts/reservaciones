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
//btn-Act
window.addEventListener('click', function(e){   
  if (document.getElementById('btnAct').contains(e.target)){

    let toggleStatus = 1;
    function toggleMenu (){
      if(toggleStatus==1){
        let ulAct = document.getElementById("ulAct");
        ulAct.classList.remove("d-none");
        ulAct.classList.add("show");
        toggleStatus = 0;
      }else if(toggleStatus==0){
        ulAct.classList.remove("show");
        ulAct.classList.add("d-none");
        toggleStatus=1;
      }
    }
    toggleMenu();
    // Clicked in box
  } else{
    if( ulAct.classList.contains("show")){
      ulAct.classList.remove("show");
      ulAct.classList.toggle("d-none");
    } 
  }
});
// btn-com
window.addEventListener('click', function(e){   
  if (document.getElementById('btnCom').contains(e.target)){

    let toggleStatus = 1;
    function toggleMenu (){
      if(toggleStatus==1){
        let ulCom = document.getElementById("ulCom");
        ulCom.classList.remove("d-none");
        ulCom.classList.add("show");
        toggleStatus = 0;
      }else if(toggleStatus==0){
        ulCom.classList.remove("show");
        ulCom.classList.add("d-none");
        toggleStatus=1;
      }
    }
    toggleMenu();
    // Clicked in box
  } else{
    if( ulCom.classList.contains("show")){
      ulCom.classList.remove("show");
      ulCom.classList.toggle("d-none");
    } 
  }
});
// btn-Cup
window.addEventListener('click', function(e){   
  if (document.getElementById('btnCup').contains(e.target)){

    let toggleStatus = 1;
    function toggleMenu (){
      if(toggleStatus==1){
        let ulCup = document.getElementById("ulCup");
        ulCup.classList.remove("d-none");
        ulCup.classList.add("show");
        toggleStatus = 0;
      }else if(toggleStatus==0){
        ulCup.classList.remove("show");
        ulCup.classList.add("d-none");
        toggleStatus=1;
      }
    }
    toggleMenu();
    // Clicked in box
  } else{
    if( ulCup.classList.contains("show")){
      ulCup.classList.remove("show");
      ulCup.classList.toggle("d-none");
    } 
  }
});

window.addEventListener('click', function(e){   
  if (document.getElementById('btnAdm').contains(e.target)){

    let toggleStatus = 1;
    function toggleMenu (){
      if(toggleStatus==1){
        let ulAdm = document.getElementById("ulAdm");
        ulAdm.classList.remove("d-none");
        ulAdm.classList.add("show");
        toggleStatus = 0;
      }else if(toggleStatus==0){
        ulAdm.classList.remove("show");
        ulAdm.classList.add("d-none");
        toggleStatus=1;
      }
    }
    toggleMenu();
    // Clicked in box
  } else{
    if( ulAdm.classList.contains("show")){
      ulAdm.classList.remove("show");
      ulAdm.classList.toggle("d-none");
    } 
  }
});




