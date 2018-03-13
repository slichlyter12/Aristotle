/*disable scroll*/
//var keys = [37, 38, 39, 40];
var keys = [];

function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}

function keydown(e) {
    for (var i = keys.length; i--;) {
        if (e.keyCode === keys[i]) {
            preventDefault(e);
            return;
        }
    }
}

function wheel(e) {
    preventDefault(e);
}

function disable_scroll() {
    if (window.addEventListener) {
        window.addEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = wheel;
    document.onkeydown = keydown;
}

function enable_scroll() {
    if (window.removeEventListener) {
        window.removeEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = document.onkeydown = null;
}
/*disable scroll end*/

//open and close the dialog
$.formBox = {
	openDialog:function(className){
		if($('.timeDetailInput').length>0)
			$('.timeDetailInput').timepicker({ 'scrollDefault': 'now' }).timepicker('setTime', new Date());
		$('#mask').fadeIn(200);
		$('#dialog .'+className).slideDown(200);
		//disable_scroll();
	}
}

function dismissModal() {
	$('#mask').fadeOut(200);
	$container = $('.close').closest('.container');
	$container.slideUp(200);
	if($container.find('form'))
		$.each($container.find('form'), function($index, $form){
			$form.reset();
	});
		
	$container.find('.timeDetailInput').attr('disabled',true);
	$container.find('input:required, textarea:required').removeClass('illegalValue');
	enable_scroll();
}

$('document').ready(function(){
	$('.close').click(function(){
		dismissModal();
	});
});

/*
$(document).mouseup(function(e) {
	var modal = $('div.container.largeBox.addClassForm');
	if (!modal.is(e.target) && modal.has(e.target).length === 0) {
		dismissModal();
	}
});
*/

//dialog from check
$.fn.checkForm = function(){
	var $fromObj = $(this);
	$inputObjs = $fromObj.find('input[type=text], textarea');
	
	$inputObjs.change(function(){
		if($(this).val().replace(/(^s*)|(s*$)/g, "").length !=0){
			$(this).removeClass('illegalValue');
		}
	});

	var n = 0;
	$.each($inputObjs, function(i, inputObj){
		var $inputObj = $(inputObj);
		//if($inputObj.val().replace(/(^s*)|(s*$)/g, "").length ==0){
		if($inputObj.val().trim().replace(/(^s*)|(s*$)/g, "").length ==0){
			$inputObj.addClass('illegalValue');
			//alert($inputObj.val());
			n++;
		}else{
			$inputObj.removeClass('illegalValue');
		}
	});

	if(n==0)return true;else return false;
};

//serialize data of the form
$.fn.serializeForm = function(){
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [ o[this.name] ];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	
	return JSON.stringify(o);
};
