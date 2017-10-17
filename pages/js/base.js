//show the toast
function openToast(str){
	$('#toast').html(str);
	$('#toast').fadeIn(200);
	setTimeout(function(){
		$('#toast').fadeOut(200);
	},3000);
};