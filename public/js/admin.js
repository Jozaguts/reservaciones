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


function showEditModal(id){

  let route = "usuarios/"+id+"/edit";

  $.get(route, function(data){
    $('#editEmail').val(data.user.email);
    $('#editFirst_name').val(data.user.first_name);
    $('#editLast_name').val(data.user.last_name);
    $('#editDepartment').val(data.user.department);
    $('#editPassword').val(data.user.password);
    $('#editRole').val(data.role);

    $('#editActive').val(data.active);

    $('#userId').val(data.id);
    if(data.active==1){
      $('#editActive').val(1);
    }else{
      $('#editActive').val(0);
    }

  });
    if(userEditModal.classList.contains("d-none")){
        userEditModal.classList.remove("d-none")
        userEditModal.classList.toggle("showModal");
    }
}

//btn actualizar
$('#btnEdit').click(function(){
  let email = $('#editEmail').val();
  let first_name = $('#editFirst_name').val();
  let last_name = $('#editLast_name').val();
  let department =$('#editDepartment').val();
  let password = $('#editPassword').val();
  let role = $('#editRole').val();
  let id =$('#userId').val();
  let active;
  if($('#editActive').is(':checked')){
    active = 0;
  }else{
    active = 1;
  }
  let route =`usuarios/${id}`
  let token = $('#token').val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'PUT',
    dataType: 'json',
    data: {email: email, first_name: first_name, last_name: last_name, department: department, password: password, role:role, active: active },
    success: function (data) {

      if(data.success == 'true'){
        $('#userEditModal').fadeOut();
        $('#success').html(data.correcto);
        $('#message-success').fadeIn();
        setTimeout(() => {
          $('#message-success').fadeOut();
        }, 3000);
        setTimeout("location.reload(true);",3000)

      }
    },
    error:function(data)
    {
      alert('hubo un error')
      if(data.status==422){
        console.clear();
      }
    }
  })
})


closeModal.addEventListener('click',(e)=>{
  e.preventDefault();
  if(closeModal.parentNode.classList.contains("showModal")){
    closeModal.parentNode.classList.remove("showModal")
    closeModal.parentNode.classList.toggle("d-none");
  }

})
//close modal edit user
closeModalEdit.addEventListener('click',(e)=>{

  if(userEditModal.classList.contains("showModal")){
    userEditModal.classList.remove("showModal")
    userEditModal.classList.add("d-none");
}


})
closeModal.addEventListener('click',(e)=>{
  if(userEditModal.classList.contains("userEditModal")){
      userEditModal.classList.remove("userEditModal")
      userEditModal.classList.add("d-none");
  }

})


//btn-Logout

// window.addEventListener('click', function(e){
//     if (document.getElementById('btnUserName').contains(e.target)){

//       let toggleStatus = 1;
//       function toggleMenu (){
//         if(toggleStatus==1){

//           btnLogOut.classList.remove("d-none");
//           btnLogOut.classList.add("show");
//           toggleStatus = 0;
//         }else if(toggleStatus==0){
//           btnLogOut.classList.remove("show");
//           btnLogOut.classList.add("d-none");
//           toggleStatus=1;
//         }
//       }
//       toggleMenu();
//       // Clicked in box
//     } else{
//       if( btnLogOut.classList.contains("show")){
//         btnLogOut.classList.remove("show");
//         btnLogOut.classList.toggle("d-none");
//       }
//     }
//   });

  //delete user
  $(document).ready(function() {

    $('.btn-delete').click(function(){


       var row = $(this).parents('tr');
       var id = row.data('id');
       var form = $('#form-delete');
       var url = form.attr('action').replace(':USER_ID', id);
       var data = form.serialize();
       var name = row.data('name');

       let alert = confirm('¿Desea eiliminara a: ' + name);

       if(alert == true){
        row.fadeOutDataCue
        $.post(url,data, function(result) {

          if(result.success == 'true')
          {

          console.log(result.message)
            $('#success').html(result.message);
            $('#message-success').fadeIn();
            setTimeout(() => {
              $('#message-success').fadeOut();
            }, 3000);
            setTimeout("location.reload(true);",1000)
          }
        });

       }


    });
 });

 //color para el tr si esta desactivado
 let elements = document.querySelectorAll('[data-active="0"]');
 elements .forEach(element => {
    element.classList.add('tr-bg');
});


// add user ajax
let addUserForm = document.getElementById('addUserForm');

addUserForm.addEventListener('submit',(e)=>{
e.preventDefault();
let datos = new FormData(addUserForm)
// console.log(datos.get('email'))
let email = datos.get('email')
let first_name = datos.get('first_name')
let last_name = datos.get('last_name')
let password = datos.get('password')
let role = datos.get('role')
let removed = datos.get('removed')
let department = datos.get('department')
let password_confirmation = datos.get('password_confirmation')


let token = $("input[name=_token]").val();
let active;
  if($('#active').is(':checked')){
    active = 0;
  }else{
    active = 1;
  }

  // if($('#remove').is(':checked')){
  //   remove = 0;
  // }else{
  //   remove = 1;
  // }
  console.log(removed);

let route = 'usuarios'

$.ajax({
  url:route,
  headers:{'X-CSRF-TOKEN':token},
  type:'POST',
  dataType: 'json',
  data: {email: email, first_name: first_name, last_name: last_name, password: password, active: active, removed: removed, role: role, department:  department, password_confirmation: password_confirmation },
  success:function(data)
  {
    if(data.success == 'false')
    {
      // $('#registerModal').fadeOut();
   data.error.forEach(function(error){
    $('#errorsIntoModal').html(error);
    $('#message-errorIntoModal').fadeIn();
   });
    }
    else{
      $('#successIntoModal').html('Usuario Agregado Correctamente');
      $('#message-successIntoModal').fadeIn();
      setTimeout(() => {
        $('#registerModal').fadeOut();
      }, 3000);
    }

},





})

})
