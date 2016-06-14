$(document).ready(function(){

		var host = window.location.origin;

		$('#wtamount').hide();
		
		$('#balanceType').change(function(){

			$('#wtamount').slideDown(500);

			var balanceType = $('#balanceType').val();
			
			$.ajax({

				'url': host + '/ajaxCheckBalanceType/' + balanceType,

				'type': 'get',

				'dataType':'json'

			}).success(function(data){

				$('#errMsgWamount').html("Available for withdrawal USD: "+ data.toFixed(2));

				$('#maxBalance').val(data);
				

			});

		}); //balance check with ajax end


		


		// cross check with available balance start
			$('#withdrawal_amount').change(function(){
				
				var withdrawAmount = parseInt(Math.floor($('#withdrawal_amount').val()));

				var maxBalance = parseInt(Math.floor($('#maxBalance').val()));


				// return keepBlock(Math.floor(withdrawAmount), Math.floor(maxBalance));

				if(withdrawAmount > maxBalance)
				{
					$('#withdrawal_amount').focus();
					
					$('#withdrawal_amount').css('border-color','red');
					
					$('#errMsgWithAmount').html('Withdrawal amount is required').fadeOut(5000);
					
					e.preventDefault();
				}
				

			});
		// cross check with available balance end



		$('#pincode').keyup(function(){
			
			var pinCode = $('#pincode').val();

			$.ajax({
				'url' : host + '/ajaxCheckWithdrawRequestPin/' + pinCode,
				'type' : 'get',
				'dataType' : 'json'
			}).success(function(data){
				// alert(data);
				$