<?php
session_start();
if (!empty($_SESSION['username']) && !empty($_SESSION['saler'])) {
    @header("Location: ./saler");
} elseif (!empty($_SESSION['username']) && !empty($_SESSION['admin'])) {
    @header("Location: ./admin");
}
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>

<head>
    <title>SalesGlide - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
    <script>
        function showPassword() {
            var x = document.getElementById("password");

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body style="height: 100%;">
    <div class="commonHeader">
        <div class="logo">
            <h3 style="font-family:Arial;letter-spacing:6px;">SALESGlide</h3>
        </div>
        <div class="date">
            <?php echo date("Y-m-d"); ?>
        </div>
    </div>

    <div class="formWrapper">

        <div class="formContainer">

            <form role="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="">
                    <label class="formfont" for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter Username" required><br>
                    <label class="formfont" for="password"><b>Password</b></label>
                    <input type="password" name="password" placeholder="Enter Password" id="password" required><br>
                    <label class="chkBoxContainer formfont">Show Password
                        <input type="checkbox" onclick="showPassword()">
                        <span class="checkmark"></span>
                    </label>
                    <input type="submit" value="Login" class="btn">
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                require "app/Connect.php";
                require "app/Sale.php";
                $username = secureinput($_POST['username']);
                $password = secureinput($_POST['password']);
                $pass = secureinput(md5(sha1($_POST['password'])));
                if (!empty($username) and !empty($pass)) {
                    $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$pass'";
                    $result = $con->query($sql);
                    if ($result->num_rows == 0) {
                        echo "<br><b><center>Wrong Username/Password</center></b>";
                    } else if ($result->num_rows == 1) {
                        while ($row = $result->fetch_array()) {
                            $role = secureinput($row['role']);
                            if ($role == "Admin") {
                                session_start();
                                $_SESSION['username'] = $username;
                                $_SESSION['admin'] = $role;
                                if (!empty($_SESSION['username']) && !empty($_SESSION['admin'])) {
                                    @header("Location: ./admin");
                                } else {
                                    echo $con->error;
                                }
                            } elseif ($role == "Saler") {
                                session_start();
                                $_SESSION['username'] = $username;
                                $_SESSION['saler'] = $role;
                                if (!empty($_SESSION['username']) && !empty($_SESSION['saler'])) {
                                    @header("Location: saler/");
                                }
                            } else {
                                echo '<br><b><center>Wrong Username/Password</center></b>';
                            }
                        }
                    } else {
                        echo "<br><b>Try Again</b>";
                    }
                }
            }

            ?>
        </div>
    </div>

    <div class="commonFooter">
        SALESGlide &copy; <?php echo date("Y"); ?>
    </div>
</body>

</html>