<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login i-disc</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url()?>/assets/lg/images/icons/cloud.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/lg/css/main.css">
	<link href="<?= base_url(); ?>/assets/plugins/alert/iziToast.min.css" rel="stylesheet">

<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" action="<?= base_url(); ?>/logincontroller/proses" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>					
			

					<div class="container-login100-form-btn mt-4">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>												
				</form>

				<div class="login100-more" style="background-image: url('<?= base_url()?>/assets/lg/images/cole.png');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url()?>/assets/lg/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url()?>/assets/lg/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url()?>/assets/lg/js/main.js"></script>
	<script src="<?= base_url(); ?>/assets/plugins/alert/iziToast.min.js"></script>
	<script>
		<?php if (session()->getFlashdata('failed')) { ?>
        iziToast.error({
            title : 'Failed!',            
            message: "<?= session()->getFlashdata('failed'); ?>",
            position: 'topCenter'
        });
    <?php } ?>
	</script>

</body>
</html>