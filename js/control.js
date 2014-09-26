$(document).ready(function(){

	window.setInterval(function(){
		//Split timer into array 20:00 = [0]20 [1]00
		var timer = $('.timer').html().split(':');
		if(timer[0]==0 && timer[1]==0) {
			timer[0] = 20;
			timer[1] = 00;
		} else {
			if(timer[1]==0) {
				timer[0] = timer[0] - 1;
				timer[1] = 59;
			} else {
				timer[1] = timer[1] - 1;
				timer[1] = ('0' + timer[1]).slice(-2);
			}
		}
		$('.timer').html(timer[0] + ':' + timer[1]);
	},1000);

	$('.reset').click(function(){
		$('.timer').text('20:00');
	});

	/*$('.minus').click(function(){
		var timer = $('.timer').html().split(':');
		if(timer[0]==0 && timer[1]==0) {
			timer[0] = 20;
			timer[1] = 00;
		} else {
			if(timer[1]==0) {
				timer[0] = timer[0] - 2;
				timer[1] = 59;
			} else {
				timer[1] = timer[1] - 2;
				timer[1] = ('0' + timer[1]).slice(-2);
			}
		}
		$('.timer').html(timer[0] + ':' + timer[1]);
	});*/

});