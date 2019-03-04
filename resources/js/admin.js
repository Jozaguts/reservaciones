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
//obtengo los valores
let userNametitle = document.getElementById('userNameTitle')
let inputEmail = document.getElementById('editEmail')
let inputLastName =document.getElementById('editLast_name')
let inputName = document.getElementById('editFirst_name');
let inputDeparment = document.getElementById('editDepartment')
let inputRole = document.getElementById('editRole')
let inputId= document.getElementById('userId')
let inputPassword = document.getElementById('editPassword')
let inputActive = document.getElementById('editActive')

function showEditModal(id){

<<<<<<< HEAD
  let route = "'usuarios'/"+id+"/edit";

  $.get(route,function(data){
    console.log(data.email, data.first_name)
    // $('#editEmail').val(data.email);
    
=======
  let route = "usuarios/"+id+"/edit";

  $.get(route,function(data){
    $('#editEmail').val(data.email);
    $('#editFirst_name').val(data.first_name);
    $('#editLast_name').val(data.last_name);
    $('#editDepartment').val(data.department);
    $('#userId').val(data.id);
    if(data.active==1){
      $('#editActive').val(1);
    }else{
      $('#editActive').val(0);
    } 
>>>>>>> 258e5f274e3584bcd333662b25efd250274dc02b

  });
    if(userEditModal.classList.contains("d-none")){
        userEditModal.classList.remove("d-none")
        userEditModal.classList.toggle("showModal");
    }
<<<<<<< HEAD
  
}

=======
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
      console.log(data);
      if(data.success == 'true'){
        alert('funciona');
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

>>>>>>> 258e5f274e3584bcd333662b25efd250274dc02b

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
        row.fadeOut();

        $.post(url,data, function(result){
             alert(result);
        });
       }

       
    });
 });


//   //edit user
//   $(document).ready(function() {
  
//     $('.btnEdit').click(function(){

      
//        var row = $(this).parents('tr');
//        let first_name = $('#editFirst_name')
//        var id = row.data('id');
//        var form = $('#form-edit');
//        var url = form.attr('action').replace(':USER_ID', id);
//        let token = $('#token').val();
//        console.log(id);

//         // $.post(url,data, function(result){
//         //      alert(result);
//         // });
//        $.ajax({
//          url:url,
//          headers:{'X-CSRF-TOKEN': token},
//          type: 'PUT',
//          dataType: 'json',
//          data:{first_name: first_name},
//          success: function (data) {
          
//           if(data.success == 'true'){
//             alert('correcto')
//           }
//          },
//          error: function (data) {
//            $('#error').html(data.responseJSON.name);
//           if(data.status == 422){
//             console.clear();
//           }
//          }
//        })

       
//     });
//  });




// //btn edit
// $(document).ready(function() {
  
//   $('.btn-edit').click(function(){

    
//      var row = $(this).parents('tr');
//      var id = row.data('id');
//      var form = $('#show-form');
//      var url = form.attr('action').replace(':USER_ID',id);
//      let token = $('#token').val();
//      console.log(url);

//       // $.post(url,data, function(result){
//       //      alert(result);
//       // });
//       $.post(url,data, function(result){
//         alert(result);

     
//   });
// });