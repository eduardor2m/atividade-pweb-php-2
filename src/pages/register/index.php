<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <style>
        h1 {
            margin-left: 45vw;
        }

        form {
            width: 100%;
        }

        .input2 {
            margin-left: 20px;
        }

        label {
            margin-right: 20px;
            margin-left: 40px;
        }

        input {
            width: 80%;
            height: 40px;
            margin-top: 20px;
        }

        .button {
            width: 150px;
            margin-top: 20px;
            height: 40px;
            margin-left: 45vw;
            background-color: green;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }

        .ajuste {
            margin-left: 20px;
        }

        .ajuste2 {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form action="?class=user&action=register" method="post">
            <div class="form-control">
                <label for="username">Username</label>
                <input placeholder="username *" type="text" name="username" id="username" required>
            </div>
            <div class="form-control">
                <label for="fullname">Fullname</label>
                <input class="ajuste2" placeholder="fullname *" type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form-control">
                <label for="email">E-mail</label>
                <input class="ajuste" placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="pass">Password</label>
                <input placeholder="pass *" type="password" name="pass" id="pass" required>
            </div>
            <button class="button" type="submit">Register</button>
            <div class="vocative">
                <span>is already registered?</span>
                <a href="?view=login">login!</a>
            </div>
        </form>
    </div>
</body>

</html>