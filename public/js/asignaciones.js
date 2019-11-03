function asignacionesInfo(e) {
	fetch(`asignaciones/${e.id}`, {
		method: "GET"
	})
		.then(response => {
			return response.json();
		})
		.then(responseJson => {
			// info unidad
			
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
			
		})
		.catch(err => {
			console.log(err);
		});
	// REVISAR LOS OPCIONES DE EL SELECT HOARIOS
	// select horarioT
	$("#actividades").change(function(e) {
			$('#loading').removeClass('d-none')
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
					$('#loading').addClass('d-none')
				})
				.catch(err => {
					console.log(err);
				});
		}
	});
	$("#horario").change(function(e) {
		
		$('#loading').removeClass('d-none')
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
					$('#loading').addClass('d-none')
				})
				.catch(err => {
					console.log(err);
				});
		}
	});

	let ubucaciones = [];
	$("#seleccionar").on("click", function() {
		$('#loading').removeClass('d-none')
		let idUbucacion = $("#slu").val();

		if (
			!ubucaciones.includes(idUbucacion) &&
			$("#slu>option:selected").val() != undefined &&
			$("#slu>option:selected").val() != "undefined"
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
			ubucaciones.push(idUbucacion);
			$("#slu>option:selected").prop('disabled',true); 
		}
		$('#loading').addClass('d-none')
	});

	/* delete */
	document.addEventListener("click", function(e) {
		if (e.target.classList.contains("btn-danger")) {
			let indx = ubucaciones.indexOf(
				e.target.parentElement.parentElement.children[6].value
			);
			ubucaciones.splice(indx, 1);
			e.target.parentNode.parentElement.nextElementSibling.remove()
			e.target.parentElement.parentElement.remove()
		

		}
	});
}
$(".modal").on("hidden.bs.modal", function() {
	$(this)
		.find("form")
		.trigger("reset");
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
			if(jsonResponse.success){
				swal("Good job!", `${jsonResponse.success}!`, "success");
				$('#tbody').html(' ');
				$('.modal').modal('hide');

			  }

		});
});
