<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Operator</title>

<link href="css/login.css" rel="stylesheet">
</head>
<body>
	<section class="container">
		<div class="login">
			<h1>DealsMada Manage</h1>
			<form method="post" action="<?=BASE_URL?>/login">
				<p>
					<input type="text" name="login" value="" placeholder="Login" />
				</p>
				<p>
					<input type="password" name="password" value="" placeholder="Password" />
				</p>
				<p class="remember_me">
					<label> <input type="checkbox" name="remember_me" id="remember_me" />
						Remember me on this computer
					</label>
				</p>
				<p class="submit">
					<input type="submit" value="Login" />
				</p>
			</form>
		</div>
	</section>
</body>
</html>
