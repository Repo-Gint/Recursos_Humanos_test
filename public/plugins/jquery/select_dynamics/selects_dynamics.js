  /*  $(document).ready(function(){ //Este query es si se llega a utilizar dentro de la vista ya que en el get la ruta viene con eloquent
        $("#Departamento").change(function(event){
            $.get("{{ url('Puesto') }}/"+event.target.value+"/obtenerpuestos", function(response,departamento){
                console.log(departamento);
                $('#Parent').empty();
                for(i=0; i<response.length; i++){
                    $('#Parent').append('<option value="'+response[i].id+'">'+response[i].Puesto_ES+'</option>');
                }
            });
        });
    });*/

$(document).ready(function(){
    $("#Departamento_P").change(function(event){
        $.get("../Puesto/"+event.target.value+"/obtenerpuestos_dep", function(response,departamento){
            console.log(departamento);
            $('#Parent_P').empty();
            for(i=0; i<response.length; i++){
                $('#Parent_P').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
    });
});




  $(document).ready(function(){
    $("#Departament_D").change(function(event){
        $.get("../Empleado/"+event.target.value+"/getpuestos", function(response,departamento){
            console.log(departamento);
            $('#Parent_D').empty();
            for(i=0; i<response.length; i++){
                $('#Parent_D').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
        $.get("../Empleado/"+event.target.value+"/getpuestos", function(response,departamento){
            console.log(departamento);
            $('#Position_D').empty();
            for(i=0; i<response.length; i++){
                $('#Position_D').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
    });
});
  






$(document).ready(function(){
    $("#Departament").change(function(event){
        $.get("/Empleado/"+event.target.value+"/getpuestos", function(response,departamento){
            console.log(departamento);
            $('#Paren').empty();
            for(i=0; i<response.length; i++){
                $('#Paren').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
    });
});
$(document).ready(function(){   

    $("#Departament").change(function(event){
        $.get("/Empleado/"+event.target.value+"/getpuestos", function(response,departamento){
            console.log(departamento);
            $('#Puesto').empty();
            for(i=0; i<response.length; i++){
                $('#Puesto').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
    });
});
/*    $(document).ready(function(){
    $("#Departamento_p").change(function(event){
        $.get("/Puesto/"+event.target.value+"/obtenerpuestos", function(response,departamento){
            console.log(departamento);
            $('#Parent_Position').empty();
            for(i=0; i<response.length; i++){
                $('#Parent_Position').append('<option value="'+response[i].id+'">'+response[i].Position_ES+'</option>');
            }
        });
    });
});


$(document).ready(function(){
    dep = $("#Departamento").val();
    
        $.get("/Empleado/"+dep+"/obtenerempleado", function(response,departamento){
            console.log(departamento);
            $('#Parent').empty();
            $('#Parent').append('<option value="">Selecciona a su superior</option>');
            for(i=0; i<response.length; i++){
                $('#Parent').append('<option value="'+response[i].Empleado_id+'">'+response[i].Names+' '+response[i].Paternal+'</option>');
            }
        });
    
    $("#Departamento").change(function(event){
        $.get("/Empleado/"+event.target.value+"/obtenerempleado", function(response,departamento){
            console.log(departamento);
            $('#Parent').empty();
            $('#Parent').append('<option value="">Selecciona a su superior</option>');
            for(i=0; i<response.length; i++){
                $('#Parent').append('<option value="'+response[i].Empleado_id+'">'+response[i].Names+' '+response[i].Paternal+'</option>');
            }
        });
    });
});*/