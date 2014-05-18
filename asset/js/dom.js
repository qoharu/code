var username = document.querySelector(".username");
var password = document.querySelector(".password");
var passDua = document.querySelector('input[name="con-password"]');

var loginButton = document.querySelector(".login-in");

function login() {
	if(username.value.length > 0 && password.value.length > 0) {
		loginButton.classList.add("login-active");
	}
	else {
		loginButton.classList.remove("login-active");
	}
}

function signUp() {
	if(username.value.length > 0 && password.value.length > 0 && passDua.value.length > 0) {
		loginButton.classList.add("login-active");
	}
	else {
		loginButton.classList.remove("login-active");
	}
}

/* Upload */

var inputFile = document.querySelector(".upload-image");
var fakeUpload = document.querySelector(".fake-upload");

inputFile.onchange = function() {
	if(inputFile.value != "") {
		fakeUpload.innerHTML = inputFile.value;
	}
}

/* Home */

var as = document.querySelector(".as");
as.onclick = function() {
	this.value = "Saving...";
	this.style.opacity = ".5";
};