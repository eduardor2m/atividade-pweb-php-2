<?php
require_once "src/models/user.php";
$user = $_SESSION["loggedUser"];
if (isset($_GET["pesquisa"])) {
    $users = User::search($_GET["pesquisa"]);
} else {
    $users = User::listUsers();
}
function logOut()
{
    session_destroy();
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            width: 100%;
            margin-top: 60px;
        }

        tr,
        table,
        td {
            border: 1px solid blue;
        }

        .button {
            width: 150px;
            margin-top: 20px;
            height: 40px;
            margin-left: 45vw;
            background-color: red;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }

        .pesquisa {
            width: 70%;
            height: 40px;
        }

        .form {
            margin-left: 7%;
            font-size: 22px;
        }

        .button1 {
            width: 150px;
            margin-top: 20px;
            height: 40px;
            background-color: green;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <section>
            <form action="?tela=home" method="GET" class="form">
                <label for="pesquisa">Search User:</label>
                <input class="pesquisa" type="text" name="pesquisa" value="<?php echo isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : "" ?>">
                <button class="button1" type="submit">Search</button>
            </form>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Fullname</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getUsername() ?></td>
                        <td><?= $value->getFullname() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=user&action=logout" method="post" required>
                <button class="button" type="submit">logout</button>
            </form>
        </section>
    </div>
</body>

</html>