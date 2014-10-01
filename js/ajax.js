$(document).ready(function(){
	$('.eminus').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: 'php/use_energy.php',
			type: 'post',
			data: {'action':'use','amount':'2','account':$('.eminus').attr('account')},
			success: function(data,status) {
				var energy = $('.energy').html().split('/');
				if(energy[0]==energy[1]) {
					$('.timer').html('20:00');
				}
				if(energy[0]!=0) {
					energy[0] -= '2';
				}
				$('.energy').html(energy[0] + '/' + energy[1]);
			},
			error: function(xhr,desc,err) {
				console.log('!ERROR! ');
				console.log(xhr);
				console.log('Details: '+desc+'\nError: '+err);
			}
		});
	});
});