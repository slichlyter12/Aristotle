//init the timepicker
function getAvailableTime(){
	$timeDetailInput = $('.timeSelect .timeDetailInput');
	$laterRadioBtn = $('.timeSelect .laterRadioBtn');
	$nowRadioBtn = $('.timeSelect .nowRadioBtn');

	$timeDetailInput.change(function(){
		$laterRadioBtn.val($(this).val());
	});

	$laterRadioBtn.click(function(){
		$timeDetailInput.removeAttr('disabled');
		$(this).val($timeDetailInput.val());
	});
	
	$nowRadioBtn.click(function(){
		$timeDetailInput.attr('disabled',true);
	});

};