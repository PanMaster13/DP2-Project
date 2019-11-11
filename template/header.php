		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="/styles/header.css">
		<link rel="stylesheet" href="/styles/button.css">
		<link rel="stylesheet" href="/styles/font.css">
		<link rel="shortcut icon" href="/template/images/icon.ico" type="image/x-icon">
		<link rel="icon" href="/template/images/icon.ico" type="image/x-icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<header id="header">
		<a href="/"><img id="logo" src='/template/images/logo_white.png' alt='logo'></a>
		<button id='logout-button' onclick="location.href='/logout.php'">
			<i class='material-icons'>lock_open</i>
			Logout
		</button>
</header>

<script>
var logo = document.getElementById("logo");
var button = document.getElementById("logout-button");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50){
		logo.style.paddingTop = "0%";
		logo.style.paddingBottom = "0%";
		logo.style.width = "150px";
		button.style.marginTop = "0%";
		button.style.marginBottom = "0%";
		button.style.height = "35px";
	} else {
		logo.style.paddingTop = "2%";
		logo.style.paddingBottom = "2%";
		logo.style.width = "300px";
		button.style.marginTop = "2%";
		button.style.marginBottom = "2%";
		button.style.height = "50px";
	}
}
</script>