$checa=0;
$nocheca=0;
$nc=0;

$(function(){

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

 $('.respuestas input[type="radio"]').change(function(){
	 $name = $(this).attr('name');
	 $name = $name.split('-');
	 $name = $name[1];

	 if($(this).attr('confirma') == 1){
		 $('input[name="val-'+$name+'"]').val('checa');
	 }else{
		 $('input[name="val-'+$name+'"]').val('nocheca');
	 }

 });

	$('.botonEnviar').on('click',function(event){

		$('.respuestas input[type="hidden"]').each(function(index,val){
			if($(this).val() == 'checa'){
				$checa++;
				$(this).parent().css({
					"border": "2px solid #00b448"
				});
			}else if($(this).val() == 'nocheca'){
				$nocheca++;
				$(this).parent().css({
					"border": "2px solid #b11111"
				});
			}else{
				$nc++;
				$(this).parent().css({
					"border": "2px solid #d96f00"
				});
			}
		});

			$('#correctas').append(' '+$checa);
			$('#nocorrectas').append(' '+$nocheca);
			$('#nocontesta').append(' '+$nc);

		$('#modalRespuestas').modal('show');

	});


$('.volver').on('click',function(event){
	window.location.reload();
});


$('.lectura').on('click',function(event){
  // $('#contenidoModal .modal-body').html($(this).attr('lectura'));
  $lectura =$(this).attr('lectura');
  $.post(location.href+'/../damelectura',{lectura:$lectura},'','json')
  .done(function(data){
    if(data.error){
      $('#contenidoModal .modal-body').html('<p> Probelema al tratar de obtener la lectura </p>');
    }else {
      $('#contenidoModal .modal-body').html('<p>'+data.respuesta+'</p>');
    }
  })
  .fail(function(err){
    $('#contenidoModal .modal-body').html('<p> Probelema al tratar de obtener la lectura </p>');
  });
  $('#modalLectura').modal('show');
});



});
