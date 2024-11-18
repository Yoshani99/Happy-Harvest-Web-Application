<!DOCTYPE html>
<html>
	<head>
		<title>Feedback</title>
		<style>

            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
			*{
				margin:0;
				padding:0;
                font-family: 'Poppins', sans-serif;
			}
			body{
				display:flex;
				min-height:100vh;
				align-items:center;
				justify-content:center;
				background: #c8efd1;
			}
			.box{
				height:380px;
				width:400px;
				background:#101012;
				padding:20px;
                box-shadow: 4px 4px 2px #fdd01c;
			}
			.box div{
				color:#ffe400;
				font-size:30px;
				font-family:sans-serif;
				font-weight:800;
				text-align:center;
				padding:20px 0;
			}
			.btn{
				border-radius:20px;
				color:#fff;
				margin-top:18px;
				padding:10px;
				background-color:#47c35a;
				font-size:18px;
				border:none;
				cursor:pointer;
			}
		</style>
		
	</head>
	<body>
		<div class="box">
			<div>
				<h1>Thank You</h1><br>
				<h5>Your feedback has been submitted. We shall take it into consideration to improve our website.</h5>
				<button type="button" class="btn"><a href="home.php"style = 'color: white; text-decoration: none;'>Home</a></button>
			</div>
		</div>
	</body>
</html>
