$(function(){

	

	var host = window.location.origin;

	var deposit = $('#dposit').val();

	var pmethod = $('#pmethod').val();

	$('.pm-account').hide();

	// alert(host);



	$('.finish').prop('disabled',true);

	$('#pmethod').change(function(){

		var deposit = $('#dposit').val();

		var pmethod = $('#pmethod').val();



		if(deposit === '' || pmethod ==='' || pmethod === 0){

			$('.finish').prop('disabled',true);

		}else{

			$('.finish').prop('disabled',false);

		}

	});



	/*$('.finish').click(function(e){

		e.preventDefault();

		var deposit = $('#dposit').val();

		var pmethod = $('#pmethod').val();



		if( deposit == '' || pmethod == ''){

			$('.finish').prop('disabled',true);

		}

	});*/



				

	// $('#deposit').blur(function(){

	// 	var deposit = $('#deposit').val();



	// 	if(deposit ===''){

	// 		$('#deposit').focus();

	// 		$('#errMsgDeposit').html('Please Select depost amount');

	// 		$('#errMsgDeposit').addClass('error-msg');

	// 		$('#errMsgDeposit').css('display','inline').fadeOut(5000);

	// 	}



	// 	$('#pmethod').change(function(){

	// 		var pmethod = $('#pmethod').val();

	// 		if( pmethod == 'wb'){

	// 			// alert(pmethod);



	// 			$.ajax({

	// 				'url' : host +'/member/ajaxCheckDeposit/'+deposit,

	// 				'type' : 'get',

	// 				'dataType': 'json'

	// 			}).success(function(data){

	// 				$('#errMsgDeposit').html(data);

	// 				$('#errMsgDeposit').addClass('error-msg');

	// 				$('#errMsgDeposit').css('display','inline').fadeOut(5000);

	// 			});

	// 		}

	// 	});



		

	// });



	// $('#pmethod').change(function(){

	// 	var pmethod = $('#pmethod').val();

	// 	if( pmethod == 'pm'){

	// 		// alert(pmethod);

	// 		// $('.pm-account').fadeIn();

	// 		$('.finish').val('Pay Now');

	// 		$('.finish').addClass('perfectMoney');

	// 	}



	// });



	// $('.finish').click(function(){

	// 	// e.preventDefault();



	// 	var btnValue = $('.finish').val();

	// 	var deposit  = $('#deposit').val();

	// 	var action = "https://perfectmoney.is/api/step1.asp";

	// 	// alert(action);

	// 	// var action = host + "/user/pmpay";

	// 	if(btnValue== 'Pay Now'){

	// 		$('#depositVal').val(deposit);

	// 		// $('#memAccount').val(memAcc);

	// 		$("#depositForm").attr("action", action);
	// 		$("#depositForm").attr("target", '_blank');

	// 	}

	// })



	

});