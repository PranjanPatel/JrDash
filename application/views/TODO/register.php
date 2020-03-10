<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
         .form-control{
            width: 43%;
            display: inline;
        }
        form{
            width: 70%;
            margin-left: 30%;
            margin-top: 1%;
        }
        .btn-success{
            margin-left: 7%;
        }
        .name{
            width: 20%;
            margin-left: 3%;
        }
    </style>
</head>

<body>
    
    <form method="post" action="<?php echo site_url('Login/register'); ?>">
    <div class="form-group">
            <label for="pass">Name</label>
            <input type="text" class="form-control name" id="fname" name="fname" placeholder="First Name">
            <input type="text" class="form-control name" id="lname" name="lname" placeholder="Last Name">
        </div>    
    <div class="form-group">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="user" name="userName" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Register">
        </div>
    </form>
</body>

</html>