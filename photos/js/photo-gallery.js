$(document).ready(function(){        
	$('.pin img').on('click',function(){
		var src = $(this).attr('src');
		var img = '<img src="' + src + '" class="img-responsive" align="center" />';
		
		//start of new code new code
		var index = $(this).parent('li').index();   
		var nombre = $("#_name").val();
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;">';
		html += '<div align="left" style="padding: 18px;"><strong>' + nombre + '</strong></div>';

		html += '</div>';
		
		$('#myModal').modal();
		$('#myModal').on('shown.bs.modal', function(){
			$('#myModal .modal-body').html(html);
			//new code
			$('a.controls').trigger('click');
		})
		$('#myModal').on('hidden.bs.modal', function(){
			$('#myModal .modal-body').html('');
		});
		
		
		
		
   });	
})
        
         
$(document).on('click', 'a.controls', function(){
	var index = $(this).attr('href');
	var src = $('ul.row li:nth-child('+ index +') img').attr('src');             
	
	$('.modal-body img').attr('src', src);
	
	return false;
});