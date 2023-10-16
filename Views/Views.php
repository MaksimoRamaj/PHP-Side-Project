<!doctype html >
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <link rel="stylesheet" href="Views.css">
    <link rel="stylesheet" href="../bootstrap_css/bootstrap.css">
</head>
<body>
    <table style="border: 1px">
        <tbody>
                <form action="home.php" method="post">
                    <tr>
                        <td>
                        <label for="user_id">Vendos id: </label>
                        <input type="number" id="user_id" name="user_id">
                        </td>
                    </tr>
                    <tr><td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="shtoUser"> Shto User
                            </label>
                        </td>
                    </tr>
                    <tr><td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="shfaqUser"> Shfaq userat
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="kerkoUser"> Kerko User
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="shtoOrePune"> Shto ore pune
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="shfaqHP"> Shfaq oret e punes
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="radio" name="user" class="form-check-input" value="fshiUser">Fshi user
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="submit" class="btn btn-success">
                        </td>
                    </tr>
                </form>
        </tbody>
    </table>
</body>

</html>


