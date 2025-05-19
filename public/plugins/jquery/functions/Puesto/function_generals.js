$(document).ready(function(){
    $(".Departamento").change(function(event){
        $.get("../Puesto/"+event.target.value+"/obtener_puestos_superiores", function(response,departamento){
            console.log(departamento);
            $('.Parent').empty();
            for(i=0; i<response.length; i++){
                $('.Parent').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
            }
        });
    });
});