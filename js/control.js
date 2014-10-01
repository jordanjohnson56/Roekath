$(document).ready(function(){
	var account = $('.info').attr('account');
	window.setInterval(function(){
		//Split timer into array 20:00 = [0]20 [1]00
		var timer = $('.timer').html().split(':');
		//Split energy into array 15/20 = [0]15 [1]20
		var energy = $('.energy').html().split('/');
		if(energy[0]==energy[1]) {
			timer[0] = '00';
			timer[1] = '00';
		}
		//If timer is 00:00
		if(timer[0]==0 && timer[1]==0) {
			if(energy[0]!=energy[1]) {
				$.ajax({
					url: 'php/add_energy.php',
					type: 'post',
					data: {'account':account},
					success: function(data,status) {
						console.log(data);
						energy[0]++;
					},
					error: function(xhr,desc,err) {
						console.log('!ERROR!');
						console.log(xhr);
						console.log('Desc: '+desc+' Error: '+err);
					}
				});
				if(energy[0]!=energy[1]) {
					timer[0] = '20';
					timer[1] = '00';
				}
			}
		} else {
			//If timer is xx:00
			if(timer[1]==0) {
				timer[0]--;
				timer[1] = '59';
			} else {
				timer[1]--;
				timer[1] = ('0' + timer[1]).slice(-2);
			}
		}
		$('.timer').html(timer[0] + ':' + timer[1]);
		$('.energy').html(energy[0] + '/' + energy[1]);
	},1000);

	$('.reset').click(function(){
		$('.timer').text('00:20');
	});

	/*$('.eminus').click(function(){
		var energy = $('.energy').html().split('/');
		if(energy[0]==energy[1]) {
			$('.timer').html('20:00');
		}
		if(energy[0]!=0) {
			energy[0]--;
		}
		$('.energy').html(energy[0] + '/' + energy[1]);
	});*/

	$('.ereset').click(function(){
		var energy = $('.energy').html().split('/');
		energy[0] = energy[1];
		$('.energy').html(energy[0] + '/' + energy[1]);
		$.ajax({
			url: 'php/reset_energy.php',
			type: 'post',
			data: {'account':account},
			success: function(data,status) {
				console.log('!OK!');
			},
			error: function(xhr,desc,err) {
				console.log('!ERROR!');
				console.log(xhr);
				console.log('Desc: '+desc+' Error: '+err);
			}
		});
	});
	$('.eminus').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: 'php/use_energy.php',
			type: 'post',
			data: {'action':'use','amount':'2','account':account,'timer':$('.timer').html().split(':')},
			success: function(data,status) {
				console.log('!OK!');
				var energy = $('.energy').html().split('/');
				if(energy[0]==energy[1]) {
					$('.timer').html('20:00');
				}
				if(energy[0]!=0) {
					energy[0] -= '2';
				}
				$('.energy').html(energy[0] + '/' + energy[1]);
				console.log(data);
			},
			error: function(xhr,desc,err) {
				console.log('!ERROR! ');
				console.log(xhr);
				console.log('Details: '+desc+'\nError: '+err);
			}
		});
	});
});