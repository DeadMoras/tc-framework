<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
	
	<?php if ( !\Framework\Controllers\Auth::check() ): ?>
	<form action="/auth" method="post">
		<input type="text" name="login"><br><br>
		<input type="password" name="password"><br><br>
		<button>Ок</button>
	</form>
	<?php endif;?>

</body>
</html>