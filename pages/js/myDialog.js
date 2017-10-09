$.formBox = {
	switch:function(className){
		$('#mask').toggle();
		$('#dialog .'+className).toggle();
	}
}
$('document').ready(function(){
	$('.close').click(function(){
		$('#mask').toggle();
		$(this).closest('.container').toggle();
	});
});