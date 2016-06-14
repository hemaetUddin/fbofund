$(function(){
    $('#news-container').vTicker({ 
        speed: 500,
        pause: 1000,
        animation: 'fade',
        mousePause: false,
        showItems: 3
    });
});

$(function(){
	$('.payment-system').hide();
	$('#activate').click(function(){
		$('.message').slideUp(1200);
		$('#activate').hide(1000);
		$('.payment-system').slideDown(1500);

	});


	$('.hide-anchor').click(function(){
		$('.menuMsg').html('To get this menu please active your account!!');
	});
});