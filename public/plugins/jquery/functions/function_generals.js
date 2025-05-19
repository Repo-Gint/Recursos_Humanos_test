$(document).ready(function(){

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
    
     if($("#pagadas").val() == 1){
        $("#SI").show();
        $("#NO").hide();
        $("#Start_date").prop( "disabled", true );
        $("#Ending_date").prop( "disabled", true );
        $("#Paid_days").prop( "disabled", false );
        $("#Paid_date").prop( "disabled", false );
    }else{
        $("#SI").hide();
        $("#NO").show();
        $("#Start_date").prop( "disabled", false );
        $("#Ending_date").prop( "disabled", false );
        $("#Paid_days").prop( "disabled", true );
        $("#Paid_date").prop( "disabled", true );
    }
    $("#pagadas").change(function () { 
        if($("#pagadas").val() == 1){
            $("#SI").show();
            $("#NO").hide();
            $("#Start_date").prop( "disabled", true );
            $("#Ending_date").prop( "disabled", true );
            $("#Paid_days").prop( "disabled", false );
            $("#Paid_date").prop( "disabled", false );
        }else{
            $("#SI").hide();
            $("#NO").show();
            $("#Start_date").prop( "disabled", false );
            $("#Ending_date").prop( "disabled", false );
            $("#Paid_days").prop( "disabled", true );
            $("#Paid_date").prop( "disabled", true );
        }
    });

	//Al seleccionar el tipo de empleado se le asignara el ultmino numero de nomina o codigo de empleado
    $(".Tipo_Empleado").change(function(event){
        $.get("../Empleado/"+event.target.value+"/obtener_codigo_empleado", function(response, status){
            console.log(status);
            $('.Codigo').empty();
            $('.Codigo').val(response[0].Code+1);
            
        });
    });

  	$(".Tipo_contrato").change(function () { //Emergencia
	    if($(".Tipo_contrato").val() == 2 || $(".Tipo_contrato").val() == 3){
	        $(".Duracion").show();
	        $(".Duracion_Dias").prop( "disabled", false );
	    }else{
	        $(".Duracion").hide();
	        $(".Duracion_Dias").prop( "disabled", true );
	    }
  	});


  //Cuando cambia el valor del select position cuando se elige otro departamento.
    $(".Departament").change(function(event){
        
        $.get("../Puesto/"+event.target.value+"/obtener_puestos", function(response,departamento, p){
alert(p);
            console.log(departamento);
            $('.Position').empty();
             $('.Position').append('<option value="">Selecciona un puesto</option>');
            for(j=0; j<response.length; j++){
                for(i=0; i<response[j].Vacancies; i++){
                    $('.Position').append('<option value="'+response[j].id+'">'+response[j].Code+' - '+response[j].Position_ES+'</option>');
                }
            }
        });
    });
    $(".Position").change(function(event){
        $.get("../Empleado/"+event.target.value+"/obtener_empleado_superior", function(response,departamento){
            console.log(departamento);
            $('.Parent').empty();
            for(i=0; i<response.length; i++){
                $('.Parent').append('<option value="'+response[i].Empleado_id+'">'+response[i].Names+' '+response[i].Paternal+' '+response[i].Maternal+'</option>');
            }
        });
    });


});

