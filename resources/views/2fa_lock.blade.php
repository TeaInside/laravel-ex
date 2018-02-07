<!DOCTYPE html>
<html id="mainHTML">
<head>
	<title>Two Factor Auth</title>
	{{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/bootstrap-dialog.min.css') }}
    {{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/pnotify.custom.min.js') }}
    {{ HTML::script('assets/js/bootstrap-dialog.min.js') }}
    {{ HTML::script('assets/js/prettyFloat.min.js') }}
	{{ HTML::script('assets/js/bootbox.min.js') }}
</head>
<body>
<script type="text/javascript">
	function promptCode() {
		bootbox.prompt({
				title: "{{trans("user_texts.tfa_3")}}",
				inputType: "number",
				callback: function (result) {
					var ch = new XMLHttpRequest();
						ch.onreadystatechange = function () {
							if (this.readyState === 4) {
								if (this.responseText === "true") {
									var ch2 = new XMLHttpRequest();
										ch2.onreadystatechange = function () {
											if (this.readyState === 4) {
												document.getElementById("mainHTML").innerHTML = this.responseText;
											}
										};
										ch2.withCredentials = true;
										ch2.open("GET", "");
										ch2.send(null);
								} else {
									bootbox.confirm({ 
									  size: "small",
									  message: "{{trans("user_texts.error_tfa_1")}}<br>Do you want to try again?", 
									  callback: function(result){ 
									  	if (result) {
									  		promptCode();
									  	} else {
									  		window.location = "{{route("logout")}}";
									  	}
									  }
									})
								}
							}
						};
						ch.withCredentials = true;
						ch.open("POST", "{{route("2fa_check_code")}}");
						ch.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						ch.setRequestHeader("Requested-Wiht", "XMLHttpRequest");
						ch.send("_token={{csrf_token()}}&code="+result);
				}
			});
	}
	promptCode();
</script>
</body>
</html>