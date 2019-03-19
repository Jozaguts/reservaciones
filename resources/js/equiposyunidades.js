
// btn moto content
let motoContent = document.getElementById('motoContent')
let btnMoto = document.getElementById('btnMoto')

btnMoto.addEventListener('click',()=>{
    motoContent.classList.contains('d-none')?motoContent.classList.toggle('show')&&motoContent.classList.remove('d-none'):motoContent.classList.add('d-none')

})

// btn bus content
let busContent = document.getElementById('busContent')
let btnBus = document.getElementById('btnBus')
btnBus.addEventListener('click',()=>{
    busContent.classList.contains('d-none')?busContent.classList.toggle('show')&&busContent.classList.remove('d-none'):busContent.classList.add('d-none')

})


