$(function(){
	$('#modalButton').click(function(){
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('#modalButton1').click(function(){
		$('#modal1').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});
$(function(){
	$('#modalButton2').click(function(){
		$('#modal2').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('#modalButton3').click(function(){
		$('#modal3').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});


