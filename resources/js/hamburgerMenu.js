const btnMenu = document.getElementById("btnMenu");
const spanBtnMenu = document.getElementById('spanBtnMenu')
const hmContanier = document.getElementById('hmContanier');

window.addEventListener('click',(e)=>{


  let toggleStatus =0; //cero es oculto
  if(toggleStatus ==0 && e.target == btnMenu || e.target == spanBtnMenu)
  {
    if(hmContanier.classList.contains('d-none'))
    {
      hmContanier.classList.remove('d-none')
      hmContanier.classList.add('show')
      
    }else
    toggleStatus = 1; //uno es mostrar
          if(toggleStatus==1)
          {
            if(hmContanier.classList.contains('show'))
            {
              hmContanier.classList.remove('show')
              hmContanier.classList.add('d-none')
              toggleStatus = 0;
            }
          }
  }else{
    if(!e.target.classList.contains('hm-list__item'))
    {
      if(hmContanier.classList.contains('show'))
      {
        hmContanier.classList.remove('show')
        hmContanier.classList.add('d-none')
        toggleStatus = 0;
      }
    }
  }

})


//click para el sub menu actividades
const actLink = document.getElementById('actLink')

let subUlAct = document.getElementById('subUlAct')

actLink.addEventListener('click',(e)=>{
  let toggleStatus = 0;
  if(toggleStatus==0)
  {
    if(subUlAct.classList.contains('d-none'))
    {
      subUlAct.classList.remove('d-none')
      subUlAct.classList.add('show')
      
 
    }else{
      toggleStatus = 1;
      if(toggleStatus ==1 ){
        if(!subUlAct.classList.contains('d-none'))
    {
      subUlAct.classList.add('d-none')
      toggleStatus=0;
    }

      }

    }
   
  }
  
})
//mostrar sub-menu comisionistas
const comLink = document.getElementById('comLink')

let subUlCom = document.getElementById('subUlCom')


comLink.addEventListener('click',(e)=>{
  let toggleStatus = 0;
  if(toggleStatus==0)
  {
    if(subUlCom.classList.contains('d-none'))
    {
      subUlCom.classList.remove('d-none')
      subUlCom.classList.add('show')
      
 
    }else{
      toggleStatus = 1;
      if(toggleStatus ==1 ){
        if(!subUlCom.classList.contains('d-none'))
    {
      subUlCom.classList.add('d-none')
      toggleStatus=0;
    }

      }

    }
   
  }
  
})

//mostrar sub-menu cupones
const cupLink = document.getElementById('cupLink')

let subUlCup = document.getElementById('subUlCup')


cupLink.addEventListener('click',(e)=>{
  let toggleStatus = 0;
  if(toggleStatus==0)
  {
    if(subUlCup.classList.contains('d-none'))
    {
      subUlCup.classList.remove('d-none')
      subUlCup.classList.add('show')
      
 
    }else{
      toggleStatus = 1;
      if(toggleStatus ==1 ){
        if(!subUlCup.classList.contains('d-none'))
    {
      subUlCup.classList.add('d-none')
      toggleStatus=0;
    }

      }

    }
   
  }
  
})

//mostrar sub-menu administracion
const admLink = document.getElementById('admLink')

let subUlAdm = document.getElementById('subUlAdm')


admLink.addEventListener('click',(e)=>{
  let toggleStatus = 0;
  if(toggleStatus==0)
  {
    if(subUlAdm.classList.contains('d-none'))
    {
      subUlAdm.classList.remove('d-none')
      subUlAdm.classList.add('show')
      
 
    }else{
      toggleStatus = 1;
      if(toggleStatus ==1 ){
        if(!subUlAdm.classList.contains('d-none'))
    {
      subUlAdm.classList.add('d-none')
      toggleStatus=0;
    }

      }

    }
   
  }
  
})

