//show the toast
function openToast(str){
	$('#toast').html(str);
	$('#toast').fadeIn(200);
	setTimeout(function(){
		$('#toast').fadeOut(200);
	},3000);
};

//	storage value in session
function setSession(key, value) {
	if(typeof(Storage) !== "undefined") {
		sessionStorage[key] = value;
	}
	else {
		alert("Your browser doesn't support web storage");
	}
}

//	get value in session
function getSession(key) {
	if(typeof(Storage) !== "undefined") {
		return sessionStorage[key];
	}
	else {
		alert("Your browser doesn't support web storage");
		return null;
	}
}
