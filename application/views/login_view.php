<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .form-control{
            width: 65%;
            display: inline;
        }
        form{
            width: 70%;
            margin-left: 20%;
            margin-top: 1%;
        }
        .btn-success{
            margin-left: 7%;
        }
    </style>
</head>

<body>
    
    <form method="post" action="<?php echo site_url('Login/process'); ?>">
        <div class="form-group">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
        </div>
        <?php echo isset($error) ? $error : ''; ?>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Login">
            <input type="button" class="btn btn-info"  onclick="window.location='<?php echo site_url("Login/openRegister");?>'" value="Register Here">
            
        </div>
    </form>
</body>

</html>