var togglePassword = document.getElementById("toggle-password");

if (togglePassword) {
	togglePassword.addEventListener('click', function() {
	  var x = document.getElementById("password");
	  var y = document.getElementById('password-confirm');
	  
	  if (x.type === "password") {
	    x.type = "text";
	    y.type = "text";
	  } else {
	    x.type = "password";
	    y.type = "password";
	  }
	});
}
