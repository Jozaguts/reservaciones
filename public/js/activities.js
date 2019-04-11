
// mostrar contenido de los boones
showContent = function (e){
    e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
  }
  
//cambiar a color a inactivos
  let elements = document.querySelectorAll('[data-active="0"]');
elements .forEach(element => {
   element.classList.add('tr-bg');
});