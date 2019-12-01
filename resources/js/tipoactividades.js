import Vue from 'vue';
window.Vue = require('vue');
import Vuetify from 'vuetify';
Vue.use(Vuetify);

Vue.component('color-picker', require('./components/ColorPickerComponent.vue').default);
Vue.component('form-tipo-actividad',require('./views/modals/TipoActividad').default);

Vue.use(Vuetify);

let colorPicker = new Vue({
    el: "#tipo_actividad_modal",
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi', // default - only for display purposes
        },
    })
});

window.addEventListener('click', function (e) {
    if (document.getElementById('btnUserName').contains(e.target)) {

        let toggleStatus = 1;

        function toggleMenu() {
            if (toggleStatus == 1) {

                btnLogOut.classList.remove("d-none");
                btnLogOut.classList.add("show");
                toggleStatus = 0;
            } else if (toggleStatus == 0) {
                btnLogOut.classList.remove("show");
                btnLogOut.classList.add("d-none");
                toggleStatus = 1;
            }
        }
        toggleMenu();
        // Clicked in box
    } else {
        if (btnLogOut.classList.contains("show")) {
            btnLogOut.classList.remove("show");
            btnLogOut.classList.toggle("d-none");
        }
    }
});




// // Show edit modal activities
// let tipoActividadEditModal = document.getElementById('TAEditModal')
// let bginput = document.getElementById('editColor')
// let colorIcon = document.getElementById('colorIcon');

// function showEditModal(id) {

//     let route = "tipoactividades/" + id + "/edit";

//     $.get(route, function (data) {
//         $('#editClave').val(data.clave);
//         $('#editNombre').val(data.nombre);
//         bginput.setAttribute("value", data.color);
//         colorIcon.style.backgroundColor = data.color;
//         $('#editColor').val(data.color);
//         $('#editRemove').val(data.remove);
//         $('#editId').val(data.id)
//         $('#editTipoUnidad').val(data.tipounidad_id)



//         $('#editIdUsuario').val();
//         $('#editActive').val(data.active);

//         if (data.active == 0) {
//             $("#editActive").prop("checked", true);
//         } else {
//             $("#editActive").prop("checked", false);
//         }

//     });

//     if (tipoActividadEditModal.classList.contains("d-none")) {
//         tipoActividadEditModal.classList.remove("d-none")
//         tipoActividadEditModal.classList.toggle("showModal");
//     }

// }

// const closeModalEdit = document.getElementById("closeModalEdit");

// closeModalEdit.addEventListener('click', () => {
//     if (tipoActividadEditModal.classList.contains('showModal')) {
//         tipoActividadEditModal.classList.remove('showModal');
//         tipoActividadEditModal.classList.add('d-none');
//     }
// })



// //boton actualizar

// $('#btnEdit').click(function () {

//     let nombre = $('#editNombre').val();
//     let id = $('#editId').val();
//     let color = $('#editColor').val();
//     let clave = $('#editClave').val();
//     let idUsuario = $('#editIdUsuario').val();
//     let tipounidad_id = $('#editTipoUnidad').val();
//     let editRemove = $('#editRemove').val();

//     let remove = $('#editRemove').val();

//     let active;
//     if ($('#editActive').is(':checked')) {
//         active = 0;
//     } else {
//         active = 1;
//     }
//     let route = `tipoactividades/${id}`


//     $.ajax({
//         url: route,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         type: 'PUT',
//         dataType: 'json',
//         data: {
//             nombre: nombre,
//             color: color,
//             clave: clave,
//             active: active,
//             id: id,
//             usuarios_id: idUsuario,
//             remove: remove,
//             tipounidad_id: tipounidad_id
//         },

//         success: function (data) {

//             console.log(data);
//             if (data.error == 'true') {
//                 $('#error').html(data.errors);
//                 $('#message-error').fadeIn();
//                 setTimeout(() => {
//                     $('#message-error').fadeOut();
//                 }, 3000);
//                 // setTimeout("location.reload(true);",3000)

//             } else {
//                 $('#success').html(data.ok);
//                 $('#message-success').fadeIn();
//                 setTimeout(() => {
//                     $('#message-success').fadeOut();
//                 }, 3000);
//                 setTimeout("location.reload(true);", 3000)
//             }
//         }
//     })
// })


// // Eliminar unidad
// $(document).ready(function () {

//     $('.btn-delete').click(function () {


//         var row = $(this).parents('tr');
//         var id = row.data('id');
//         var form = $('#form-delete');
//         var url = form.attr('action').replace(':TIPO_ID', id);
//         var data = form.serialize();

//         var name = row.data('clave');


//         let alert = confirm('¿Desea eiliminara a: ' + name);

//         if (alert == true) {
//             row.fadeOut();

//             $.post(url, data, function (result) {

//                 if (result.success == 'true') {

//                     // $('#modalEditEquipoUnidad').fadeOut();
//                     $('#success').html(result.correcto);
//                     $('#message-success').fadeIn();
//                     setTimeout(() => {
//                         $('#message-success').fadeOut();
//                     }, 3000);
//                     setTimeout("location.reload(true);", 3000)

//                 } else {
//                     $('#modalEditEquipoUnidad').fadeOut();
//                     $('#success').html(result.error);
//                     $('#message-success').fadeIn();
//                     setTimeout(() => {
//                         $('#message-success').fadeOut();
//                     }, 3000);
//                     setTimeout("location.reload(true);", 3000)
//                 }


//             });
//         }


//     });
// });

//cambiar a color a inactivos
let elements = document.querySelectorAll('[data-active="0"]');
elements.forEach(element => {
    element.classList.add('tr-bg');
});
