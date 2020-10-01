<!DOCTYPE html>
<html>
<head>
	<title>Login | Practically</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="quarter-circle-top-left"></div>
    <section class="h-100 w-100 container">
		<div>
			<h1 class="white">Welcome back!!!</h1>
			<h1 class="white">Login to continue to your account</h1>
		</div>    	
        <div class="row justify-content-center align-items-center">
            <div class='col-md-6 col-12'>
                <form style="background-color: white;margin-top: 5%;border: 0 solid #DC567E;box-shadow: 0 6px 23px -3px rgba(220,86,126,0.18);border-radius: 20px;padding: 40px;" action="login.php" method="POST">
                      <div class="form-group border-lable-flt">
                        <input type="mail" name="mail" onfocusout="validator(this)" oninvalid="validator(this)" class="form-control"  id="mail" placeholder=" " pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <label for="mail">Email</label>
                        <span for="mail" style="font-family: Poppins-Regular; font-size: 10px; color: #DC567E;"></span>
                      </div>
                      <div class="form-group border-lable-flt">
                        <!-- INCLUDE PATTERN VARIABLE IN THE INPUT TAG IF YOU WANT A SPECIFIC PATTERN TO BE FOLLOWED FOR PASSWORS -->
                        <input type="password" name="password" onfocusout="validator(this)" oninvalid="validator(this)" class="form-control" id="password" placeholder=" " required>
                        <label for="password">Password</label>
                        <span for="password" style="font-family: Poppins-Regular; font-size: 10px; color: #DC567E;"></span>
                      </div>
                      <div class="text-right" style="color: #0091FF;"><a href="forgotPassword.php"> Forgot Password or Login ID?</a></div>
                      <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControl1" required>
                        <label class="custom-control-label" for="customControl1">Stay Signed In</label>
                      </div>
                      <br>
                      <div class="d-flex align-items-center justify-content-center">
                      <button type="submit" style="width: 50%;" value="POST" name="submit" class="btn golden-btn">Login</button>                          
                      </div>
                </form>
                <br>
                <p class="text-center">Do not have an account? <a href="signup.html"><strong>Register now</strong></a></p>
            </div>
        </div>        
    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>