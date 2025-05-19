/*
 * Esta funcion se llama desde la vista de empleado Create & Edit & Show  
 * para obtener los puestos del departamento seleccionado y los empleados existentes
 */
$(document).ready(function(){

    //Al seleccionar la imagen del empleado se carga y vizualiza dentro de la interfaz.
    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_destino').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imagen").change(function(){
        preview(this);
    });


    //Si en el formulario de crear o editar se actualiza o refresca la pagina aparezcan los datos que se ingresaron antes de refresqueo
    if($("#Tipo_contrato").val() == 2 || $("#Tipo_contrato").val() == 3){
        $("#Duracion").show();
        $("#Dur").prop( "disabled", false );
    }else{
        $("#Duracion").hide();
        $("#Dur").prop( "disabled", true );
    }
    
    //Al seleccionar el tipo de contrato se visualizara o no el campo de duración de contrato.
    $("#Tipo_contrato").change(function () { //Emergencia
        if($("#Tipo_contrato").val() == 2 || $("#Tipo_contrato").val() == 3){
            $("#Duracion").show();
            $("#Dur").prop( "disabled", false );
        }else{
            $("#Duracion").hide();
            $("#Dur").prop( "disabled", true );
        }
      });


    //Al seleccionar el tipo de empleado se le asignara el ultmino numero de nomina o codigo de empleado
    $("#Tipo").change(function(event){
        $.get("/Empleado/"+event.target.value+"/obtenercodigo", function(response, status){
            console.log(status);
            $('#Codigo').empty();
            $('#Codigo').val(response[0].Code+1);
            
        });
    });



    //Cuando cambia el valor del select position cuando se elige otro departamento.
    $("#Departamento_E").change(function(event){
        $.get("/Puesto/"+event.target.value+"/obtenerpuestos", function(response,departamento){
            console.log(departamento);
            $('#Position_E').empty();
             $('#Position_E').append('<option value="">Selecciona un puesto</option>');
            for(j=0; j<response.length; j++){
                for(i=0; i<response[j].Vacancies; i++){
                    $('#Position_E').append('<option value="'+response[j].id+'">'+response[j].Code+' - '+response[j].Position_ES+'</option>');
                }
            }
        });
    });
    $("#Position_E").change(function(event){
        $.get("/Empleado/"+event.target.value+"/obtenerempleado", function(response,departamento){
            console.log(departamento);
            $('#Parent_E').empty();
            for(i=0; i<response.length; i++){
                $('#Parent_E').append('<option value="'+response[i].Empleado_id+'">'+response[i].Names+' '+response[i].Paternal+' '+response[i].Maternal+'</option>');
            }
        });
    });

    //Cuando cambia el valor del select position cuando se elige otro departamento.
    $("#Departamento_S").change(function(event){
        $.get("/Puesto/"+event.target.value+"/obtenerpuestos", function(response,departamento){
            console.log(departamento);
            $('#Position_S').empty();
             $('#Position_S').append('<option value="">Selecciona un puesto</option>');
            for(j=0; j<response.length; j++){
                for(i=0; i<response[j].Vacancies; i++){
                    $('#Position_S').append('<option value="'+response[j].id+'">'+response[j].Code+' - '+response[j].Position_ES+'</option>');
                }
            }
        });
    });
    $("#Position_S").change(function(event){
        $.get("/Empleado/"+event.target.value+"/obtenerempleado", function(response,departamento){
            console.log(departamento);
            $('#Parent_S').empty();
            for(i=0; i<response.length; i++){
                $('#Parent_S').append('<option value="'+response[i].Empleado_id+'">'+response[i].Names+' '+response[i].Paternal+' '+response[i].Maternal+'</option>');
            }
        });
    });
});