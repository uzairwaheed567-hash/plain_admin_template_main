<?php
session_start();
@include("includes/db.php");
 @include('classes/Data.user.php');
$message = ''; 
if(isset($_POST['login'])){
    $response = Data::login($conn, $_POST);
    if($response){
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid Email or Password!";
    }
}
?>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- Left Side -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">

            <div class="w-75">

                <h2 class="fw-bold mb-3">Welcome Back</h2>

                <p class="text-muted mb-4">
                    Please enter your Email & Password
                </p>

                <?php if(!empty($message)){ ?>
                    <div class="alert alert-danger">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control form-control-lg"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control form-control-lg"
                               required>
                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox">
                            <label class="form-check-label">
                                Remember me
                            </label>
                        </div>

                        <a href="#">
                            Forgot Password?
                        </a>

                    </div>

                    <button type="submit"
                            name="login"
                            class="btn btn-primary btn-lg w-100">
                        Sign In
                    </button>

                </form>

            </div>

        </div>

       <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-white">

    <img src="assets/images/undr.png"
         class="img-fluid"
         style="max-width:100%; max-height:100vh;">

</div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>