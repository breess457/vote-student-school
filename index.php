<?php

session_start();
session_destroy();
include('public/link.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Awesome Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="assets/scss/index.login.css">
</head>
<!--Coded with love by Mutiullah Samim-->

<body id="LoginForm">
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/image/logo_school.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center mb-0">
					<p class="text-center alert alert-info x-p font-weight-bold">ระบบโหวต การอาชีพปัตตานี</p>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="student/chk_login.php" method="POST">
						<label for="" class="mb-0">รหัสนักศึกษา</label>
						<div class="input-group mb-1">
							<div class="input-group-append">
								<span class="input-group-text"><i class="far fa-credit-card"></i></span>
							</div>
							<input type="text" name="codestd" class="form-control input_user" value="" placeholder="username">
						</div>
						<label for="" class="mb-0">รหัสผ่าน</label>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="passwd" class="form-control input_user" value="" placeholder="Password">
							<!-- <input type="select" name="department" class="form-control input_pass" value="" placeholder="password"> -->
						</div>
						<div class=" justify-content-center mt-2">
							<button type="submit" class="btn btn-block btn-primary">
								<i class="fas fa-sign-in-alt"></i> Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>