
function asignacionesInfo(e) {
	fetch(`asignaciones/${e.id}`, {
		method: "GET"
	})
		.then(response => {
			return response.json();
		})
		.then(responseJson => {

			$('#tbody').html('');
			if(responseJson.forms){
				let i=0,
				length =responseJson.forms.length;
				let tbody = document.getElementById('tbody');
				for (i; i < length; i++) {
					tbody.innerHTML +=responseJson.forms[i];
				}
				let salida_llegada_id = document.querySelectorAll('[name=salida_llegada_id]')
				salida_llegada_id.forEach((salida)=>{
					ubicaciones.push(salida.value)

				})

					
				const UNIDAD_INFO = responseJson.unidadInfo;
				$("#unidad_id").val("");
				$("#unidad_id").val(e.id);
				$("#clave").val(UNIDAD_INFO.clave);
				$("#nombre").val(UNIDAD_INFO.nombre);
				$("#capacidad").val(UNIDAD_INFO.capacidad);
				$("#placa").val(UNIDAD_INFO.placa);
				$("#tipo_unidad").val(UNIDAD_INFO.tipo_unidad);
				// info select actividades
				const ACTIVIDADES = responseJson.actividades;
				$("#actividades").html("");
				$("#actividades").append(
					'<option value="undefined" selected="true">Seleccione una Actividad</option>'
				);
					for (let i = 0; i < ACTIVIDADES.length; i++) {
						let option = document.createElement("option");
						option.innerText = ACTIVIDADES[i].nombre;
						option.setAttribute("value", ACTIVIDADES[i].id);
						option.setAttribute("data-clave", ACTIVIDADES[i].clave);

						$("#actividades").append(option);
					}
			}else{
				const UNIDAD_INFO = responseJson.unidadInfo;
				$("#unidad_id").val("");
				$("#unidad_id").val(e.id);
				$("#clave").val(UNIDAD_INFO.clave);
				$("#nombre").val(UNIDAD_INFO.nombre);
				$("#capacidad").val(UNIDAD_INFO.capacidad);
				$("#placa").val(UNIDAD_INFO.placa);
				$("#tipo_unidad").val(UNIDAD_INFO.tipo_unidad);
				// info select actividades
				const ACTIVIDADES = responseJson.actividades;
				$("#actividades").html("");
				$("#actividades").append(
					'<option value="undefined" selected="true">Seleccione una Actividad</option>'
				);
					for (let i = 0; i < ACTIVIDADES.length; i++) {
						let option = document.createElement("option");
						option.innerText = ACTIVIDADES[i].nombre;
						option.setAttribute("value", ACTIVIDADES[i].id);
						option.setAttribute("data-clave", ACTIVIDADES[i].clave);

						$("#actividades").append(option);
					}
			}
		})
		.catch(err => {
			console.log(err);
		});
	// REVISAR LOS OPCIONES DE EL SELECT HOARIOS
	// select horarioT
	$("#actividades").change(function(e) {
		$("#loading").removeClass("d-none");
		e.preventDefault();
		let idActividad = e.target.options[e.target.selectedIndex].value;
		if (idActividad != "false") {
			fetch(`asignaciones/info-actividad-horario/${idActividad}`, {
				method: "GET"
			})
				.then(response => {
					return response.json();
				})
				.then(responseJson => {
					let options = responseJson.optionsHorario;
					$("#horario").html("");
					$("#horario").append(
						'<option value="undefined" selected="true">Seleccione un Horario</option>'
					);
					options.forEach(option => {
						$("#horario").append(option);
					});
					$("#loading").addClass("d-none");
				})
				.catch(err => {
					console.log(err);
				});
		}
	});
	$("#horario").change(function(e) {
		$("#loading").removeClass("d-none");
		e.preventDefault();
		let idHorario = e.target.options[e.target.selectedIndex].value;
		if (idHorario != "false") {
			fetch(`asignaciones/salidas-llegadas/${idHorario}`, {
				method: "GET"
			})
				.then(response => {
					return response.json();
				})
				.then(responseJson => {
					let info, hora, tipo, punto;
					info = responseJson.info;
					$("#slu").html("");
					$("#slu").append(
						'<option value="undefined" selected="true">Seleccione un Horario</option>'
					);
					info.forEach(salida => {
						hora = salida.hora;
						tipo = salida.tipo;
						punto = salida.punto;
						id = salida.sal_lleg_hor_id;
						$("#slu").append(
							`<option value="${id}" data-hora="${hora}" data-punto="${punto}" data-libre-o-multiple="${tipo}"> ${
								hora === null ? "Libre" : hora
							}  | ${tipo} | ${punto}</option>`
						);
					});
					$("#loading").addClass("d-none");
				})
				.catch(err => {
					console.log(err);
				});
		}
	});

	let ubicaciones = [];
	$("#seleccionar").on("click", function() {
		$("#loading").removeClass("d-none");
		evaluarSelectsSinOpcionSeleccionada();


		let idUbucacion = $("#slu").val();
		console.log(idUbucacion);
		if (

			!ubicaciones.includes(idUbucacion) &&
			$("#slu>option:selected").val() != undefined &&
			$("#slu>option:selected").val() != "undefined" &&
			$("#slu>option:selected").val() != "null" &&
			$("#slu>option:selected").val() != null &&
			idUbucacion != null &&
			idUbucacion != 'null'

		) {

			$("#actividades").val(); /*actividad_id */
			$("#horario").val(); /*actividad_horario_id */
			$("#unidad_id").val(); /* actividad_horario_id */

			let clave = $("#actividades>option:selected").data("clave"); /*CLAVE*/
			let nombre = $("#actividades>option:selected").text(); /*NOMBRE*/
			let horario; /*Horario*/

			if ($("#horario>option:selected").data("type") == "Libre") {
				horario = "Libre"; /*Horario*/
			} else {
				horario = $("#slu>option:selected").data("hora"); /*Horario*/
			}

			let salida = $("#slu>option:selected").data(
				"libre-o-multiple"
			); /* SALIDA  S o Ll === unidad_id*/

			let salidaBool = Boolean;
			salida === "S" ? (salidaBool = "1") : (salidaBool = "0");

			let ubicacion = $("#slu>option:selected").data("punto"); /* Ubucacion */

			let tbody = document.getElementById("tbody");
			tbody.innerHTML += `
        <form>
            <tr>
                <td scope="row">${clave}</td>
                <td>${nombre}</td>
                <td>${horario}</td>
                <td>${salida}</td>
                <td>${ubicacion}</td>
                <td><span class="btn btn-danger">-</span></td>
                <input type="hidden" value="${idUbucacion}">
            </tr>

            <tr name="dataAsignacion">
                <input name ="actividad_id" type="hidden" value ="${$(
									"#actividades"
								).val()}">
                <input name ="actividad_horario_id" type="hidden" value ="${$(
									"#horario"
								).val()}">
                <input name ="salida" type="hidden" value ="${salidaBool}">
                <input name ="unidad_id" type="hidden" value ="${$(
									"#unidad_id"
								).val()}">
                <input name ="salida_llegada_id" type="hidden" value ="${$(
									"#slu"
								).val()}">
            </tr>
        </form>
		`;
		if(idUbucacion!=null &&idUbucacion!= 'null'){
			ubicaciones.push(idUbucacion);
			console.log(ubicaciones);

		}

			$("#slu>option:selected").prop("disabled", true);
		}else{

		}
		$("#loading").addClass("d-none");
	});

	/* delete */
	document.addEventListener("click", function(e) {
		if (e.target.classList.contains("btn-danger")) {
			swal({
				title: "Eliminar Asignación",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willlDelete)=>{
				if(willlDelete){
					let indx = ubicaciones.indexOf(
						e.target.parentElement.parentElement.children[6].value
					);
					ubicaciones.splice(indx, 1);
					const  IdAsignacion = e.target.parentNode.parentElement.nextElementSibling.children[5].value;
					e.target.parentNode.parentElement.nextElementSibling.remove();
					e.target.parentElement.parentElement.remove();


					fetch(`/asignaciones/${IdAsignacion}`,{
						method: 'DELETE',
						headers: {
						  "Content-Type": "application/json",
						  "Accept": "application/json",
						  "X-Requested-With": "XMLHttpRequest",
						  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
						}
					})
					.then((response)=>{
						return response.json()
					})
					.then((jsonResponse)=>{
						swal("Asignación Eliminada");
					})
				}else{
					swal("Asignación No Eliminada");
				}
			})






		}
	});
}
$(".modal").on("hidden.bs.modal", function() {
	$(this)
		.find("form")
		.trigger("reset");
	find("input").trigger("reset");
});

/*
    actividad_id @INT
    actividad_horario_id @INT
    unidad_id @INT
    salida @BOOLEAN
    salida_llegada_id INT

*/
$("#guardarAsignacion").on("click", function() {
	let dataContainer = [],
		formsData = document.querySelectorAll('tr[name="dataAsignacion"]');

	if (formsData.length > 0) {
		formsData.forEach(form => {
			let i = 0,
				length = $(form).children("input").length;
			let objetcDAta = {};
			for (i = 0; i < length; i++) {
				objetcDAta[form.children[i].name] = form.children[i].value;
			}
			dataContainer.push(objetcDAta);
		});

		fetch("/asignaciones", {
			method: "POST",
			body: JSON.stringify(dataContainer),
			headers: {
				"Content-Type": "application/json",
				Accept: "application/json",
				"X-Requested-With": "XMLHttpRequest",
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			}
		})
			.then(response => {
				return response.json();
			})
			.then(jsonResponse => {
				if (jsonResponse.success) {
					swal("Good job!", `${jsonResponse.success}!`, "success");
					$("#tbody").html(" ");
					$(".modal").modal("hide");
				} else if (jsonResponse.errors) {
					let i = 0,
						length = Object.values(jsonResponse.errors).length,
						errors = Object.values(jsonResponse.errors);

					let ul = document.createElement("ul");
					for (i; i < length; i++) {
						let li = document.createElement("li");
						li.innerText = errors[i];
						ul.appendChild(li);
					}
					swal({
						title: "Error!",
						icon: "error",
						content: ul,
						closeOnClickOutside: true,
						dangerMode: true
					});
				}
			});
	} else {
		swal({
			title: "Error!",
			icon: "error",
			text: "No Hay elementos Asignados",
			closeOnClickOutside: true,
			dangerMode: true
		});
	}
});


const evaluarSelectsSinOpcionSeleccionada =()=>{
	let selectActividad = document.querySelector('#actividades');
		selectActividad.value == 'undefined' ?
		selectActividad.parentElement.children[0].innerHTML = 'Actividades <span class="text-danger">Seleccione una actividad</span>':
		selectActividad.parentElement.children[0].innerHTML = "Actividades";
	let selectHorario = document.querySelector('#horario');
		selectHorario.value == '' || selectHorario.value == 'undefined' ?
		selectHorario.parentElement.children[0].innerHTML = 'Horario <span class="text-danger">Seleccione un Horario</span>':
		selectHorario.parentElement.children[0].innerHTML = "Horario";
	let slu = document.querySelector('#slu');
		slu.value == '' || slu.value == 'undefined' ?
		slu.parentElement.children[0].innerHTML = '<span class="text-danger" style="font-size: 12px;" >Seleccione una Salida | Llegada | Ubicación </span>':
		slu.parentElement.children[0].innerHTML = "Salida | Llegada | Ubicación";

}
