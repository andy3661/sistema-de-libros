import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';


//ajax request
$( "#category" ).change(function() {
   
    console.log( 'entra ajax');
        let category= $("#category").val();
        $.ajax({
            method: 'get',
            data: category,
            url: 'filtrar/'+category,
            dataType: "json",
            success: function (json) {
                $("#div-tabla").html(json);
                //			$(".modal-dialog").removeClass("modal-lg");
                // $("#ModalGeneralMessage").html(data.formulario);
                // $("#ModalGeneral").modal("show");
                
                setTimeout(function () {
                    validarEnviarFormTerceros('editar');
                    cargarCombosUbicacion();
                }, 1800);
            },
        
        });
        console.log( "ready!" );
    });
function Buscar() {
	
	 
	
		
	
}