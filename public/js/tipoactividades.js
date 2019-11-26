/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/tipoactividades.js":
/*!*****************************************!*\
  !*** ./resources/js/tipoactividades.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.addEventListener('click', function (e) {
  if (document.getElementById('btnUserName').contains(e.target)) {
    var toggleMenu = function toggleMenu() {
      if (toggleStatus == 1) {
        btnLogOut.classList.remove("d-none");
        btnLogOut.classList.add("show");
        toggleStatus = 0;
      } else if (toggleStatus == 0) {
        btnLogOut.classList.remove("show");
        btnLogOut.classList.add("d-none");
        toggleStatus = 1;
      }
    };

    var toggleStatus = 1;
    toggleMenu(); // Clicked in box
  } else {
    if (btnLogOut.classList.contains("show")) {
      btnLogOut.classList.remove("show");
      btnLogOut.classList.toggle("d-none");
    }
  }
}); //mostrar modal agregar Actividad

var btnAddTipoActividad = document.getElementById('btnAddTipoActividad');
var modalAddTipoActidades = document.getElementById('modalAddTipoActidades');
btnAddTipoActividad.addEventListener('click', function () {
  var toggleStatus = 0;

  if (toggleStatus == 0) {
    if (modalAddTipoActidades.classList.contains('d-none')) {
      modalAddTipoActidades.classList.remove('d-none');
      modalAddTipoActidades.classList.add('showModal');
      toggleStatus = 1;
    }
  } else {
    if (toggleStatus = 1) {
      if (!modalAddTipoActidades.classList.contains('d-none')) {
        modalAddTipoActidades.classList.add('d-none');
        toggleStatus = 0;
      }
    }
  }
});
var closeModal = document.getElementById('closeModal');
closeModal.addEventListener('click', function (e) {
  if (e.target == closeModal) {
    //closeModal is a icon element like <X>
    if (modalAddTipoActidades.classList.contains('showModal')) {
      modalAddTipoActidades.classList.remove('showModal');
      modalAddTipoActidades.classList.add('d-none');
    }
  }
});
var AddTipoActividadesForm = document.getElementById('AddTipoActividadesForm');
AddTipoActividadesForm.addEventListener('submit', function (e) {
  e.preventDefault();
  var datos = new FormData(AddTipoActividadesForm);
  var clave = datos.get('clave');
  var tipounidad = datos.get('tipounidad');
  var nombre = datos.get('nombre');
  var color = datos.get('color');
  var token = $("input[name=_token]").val();
  var usuarios_id = datos.get('idusuario');
  var active;

  if ($('#active').is(':checked')) {
    active = 0;
  } else {
    active = 1;
  }

  var remove;

  if ($('#remove').is(':checked')) {
    remove = 0;
  } else {
    remove = 1;
  }

  var route = 'tipoactividades';
  $.ajax({
    url: route,
    headers: {
      'X-CSRF-TOKEN': token
    },
    type: 'POST',
    dataType: 'json',
    data: {
      clave: clave,
      nombre: nombre,
      color: color,
      usuarios_id: usuarios_id,
      active: active,
      remove: remove,
      tipounidad_id: tipounidad
    },
    success: function success(data) {
      if (data.error == 'true') {
        $('#errorsIntoModal').html(data.errors);
        $('#message-errorIntoModal').fadeIn();
        setTimeout(function () {
          $('#message-error').fadeOut();
        }, 3000); // setTimeout("location.reload(true);",3000)
      } else {
        $('#successIntoModal').html(data.ok);
        $('#message-successIntoModal').fadeIn();
        setTimeout(function () {
          $('#message-successIntoModal').fadeOut();
        }, 3000);
        setTimeout("location.reload(true);", 3000);
      }
    }
  });
}); // Show edit modal activities

var tipoActividadEditModal = document.getElementById('TAEditModal');
var bginput = document.getElementById('editColor');
var colorIcon = document.getElementById('colorIcon');

function showEditModal(id) {
  var route = "tipoactividades/" + id + "/edit";
  $.get(route, function (data) {
    $('#editClave').val(data.clave);
    $('#editNombre').val(data.nombre);
    bginput.setAttribute("value", data.color);
    colorIcon.style.backgroundColor = data.color;
    $('#editColor').val(data.color);
    $('#editRemove').val(data.remove);
    $('#editId').val(data.id);
    $('#editTipoUnidad').val(data.tipounidad_id);
    $('#editIdUsuario').val();
    $('#editActive').val(data.active);

    if (data.active == 0) {
      $("#editActive").prop("checked", true);
    } else {
      $("#editActive").prop("checked", false);
    }
  });

  if (tipoActividadEditModal.classList.contains("d-none")) {
    tipoActividadEditModal.classList.remove("d-none");
    tipoActividadEditModal.classList.toggle("showModal");
  }
}

var closeModalEdit = document.getElementById("closeModalEdit");
closeModalEdit.addEventListener('click', function () {
  if (tipoActividadEditModal.classList.contains('showModal')) {
    tipoActividadEditModal.classList.remove('showModal');
    tipoActividadEditModal.classList.add('d-none');
  }
}); //boton actualizar

$('#btnEdit').click(function () {
  var nombre = $('#editNombre').val();
  var id = $('#editId').val();
  var color = $('#editColor').val();
  var clave = $('#editClave').val();
  var idUsuario = $('#editIdUsuario').val();
  var tipounidad_id = $('#editTipoUnidad').val();
  var editRemove = $('#editRemove').val();
  var remove = $('#editRemove').val();
  var active;

  if ($('#editActive').is(':checked')) {
    active = 0;
  } else {
    active = 1;
  }

  var route = "tipoactividades/".concat(id);
  $.ajax({
    url: route,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'PUT',
    dataType: 'json',
    data: {
      nombre: nombre,
      color: color,
      clave: clave,
      active: active,
      id: id,
      usuarios_id: idUsuario,
      remove: remove,
      tipounidad_id: tipounidad_id
    },
    success: function success(data) {
      console.log(data);

      if (data.error == 'true') {
        $('#error').html(data.errors);
        $('#message-error').fadeIn();
        setTimeout(function () {
          $('#message-error').fadeOut();
        }, 3000); // setTimeout("location.reload(true);",3000)
      } else {
        $('#success').html(data.ok);
        $('#message-success').fadeIn();
        setTimeout(function () {
          $('#message-success').fadeOut();
        }, 3000);
        setTimeout("location.reload(true);", 3000);
      }
    }
  });
}); // Eliminar unidad

$(document).ready(function () {
  $('.btn-delete').click(function () {
    var row = $(this).parents('tr');
    var id = row.data('id');
    var form = $('#form-delete');
    var url = form.attr('action').replace(':TIPO_ID', id);
    var data = form.serialize();
    var name = row.data('clave');
    var alert = confirm('¿Desea eiliminara a: ' + name);

    if (alert == true) {
      row.fadeOut();
      $.post(url, data, function (result) {
        if (result.success == 'true') {
          // $('#modalEditEquipoUnidad').fadeOut();
          $('#success').html(result.correcto);
          $('#message-success').fadeIn();
          setTimeout(function () {
            $('#message-success').fadeOut();
          }, 3000);
          setTimeout("location.reload(true);", 3000);
        } else {
          $('#modalEditEquipoUnidad').fadeOut();
          $('#success').html(result.error);
          $('#message-success').fadeIn();
          setTimeout(function () {
            $('#message-success').fadeOut();
          }, 3000);
          setTimeout("location.reload(true);", 3000);
        }
      });
    }
  });
}); //cambiar a color a inactivos

var elements = document.querySelectorAll('[data-active="0"]');
elements.forEach(function (element) {
  element.classList.add('tr-bg');
});

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/tipoactividades.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\reservaciones\resources\js\tipoactividades.js */"./resources/js/tipoactividades.js");


/***/ })

/******/ });