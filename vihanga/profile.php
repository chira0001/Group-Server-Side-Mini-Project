<?php
session_start();
$_SESSION["email"] = 'vihaga@gmail.com';
$_SESSION["first-name"] = 'Pappa';
$_SESSION["last-name"] = 'yasotha';
$_SESSION["password"] = '1234';


$fname = $phone = $lname = '';
require_once('connection.php');
if (isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["first-name"]) && isset($_SESSION["last-name"])) {
    $email = $_SESSION["email"];
    $fname = $_SESSION["first-name"];
    $lname = $_SESSION["last-name"];
    $password = $_SESSION["password"];
}

//access pooja databases
/*$quary = "SELECT * FROM signup_details WHERE email = '$email';";
$resualt = mysqli_query($connect, $quary);
while ($row = mysqli_fetch_assoc($resualt)) {
    if ($email == $row['email']) {
        break; //use the data for pooja.databases
    }
}*/
$count = 1;
$quary = "SELECT * FROM user;";
$resualt = mysqli_query($conn, $quary);
if (mysqli_num_rows($resualt) > 0) {
    while ($userData = mysqli_fetch_assoc($resualt)) {
        if ($userData['user_email'] == $email) {
            $count++;
            break;
        }
    }
    if ($count > 1) {
        $phone = $userData['phone'];
    }
    /*$quary = 'SELECT * FROM user';
    $resualt = mysqli_query($connect, $quary);
    $last_id = mysqli_num_rows($resualt);
    $last_id++;*/

} else {
    echo "<script> alert('ERORR_x0001%'); </script>";
}

//$_SESSION['user_id'] = $userId;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap"
        rel="stylesheet">
    <meta http-equiv="refresh" content="300">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(179, 179, 179, 0.552);
            font-size: 16px;
            font-family: "Roboto", sans-serif;
        }

        .main-sub {
            width: 85%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0;
        }

        .left-box {
            width: 400px;
            height: 500px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            box-shadow: 0 0 5px 0 rgba(58, 58, 58, 0.593);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-box>nav {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 390px;
        }

        .left-box>nav>div {
            height: auto;
        }

        .addPhoto {
            gap: 10px;
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .addPhoto .btn0,
        .addPhoto .btn1 {
            font-size: 15px;
            font-weight: bold;
            width: 200px;
            padding: 8px 10px;
            border-radius: 5px;
            border: none;
            background-color: rgba(0, 209, 223, 0.801);
            color: rgba(13, 13, 13, 0.816);
        }

        .addPhoto .data {
            text-align: center;
            width: max-content;
            height: auto;
            font-size: 19px;
            font-weight: bold;
            border-bottom: solid 2px rgba(0, 0, 0, 0.285);
            color: rgba(13, 13, 13, 0.814);
            padding: 5px 20px 1px 20px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            transition: all 0.5s;
            cursor: pointer;
        }

        .addPhoto .data:hover {
            padding: 0px 80px 10px 80px;
            margin-top: 10px;
        }

        .addPhoto>div {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }

        .left-box>nav>div>.profile {
            width: 140px;
            height: 140px;
            border: solid 5px rgba(0, 21, 255, 0.553);
            border-radius: 100%;
            /*background-image: url('displayImage.php?id=1');*/
            background-image: url('b1.jpeg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .right-box {
            width: 800px;
            height: 500px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            box-shadow: 0 0 5px 0 rgba(58, 58, 58, 0.593);
        }

        .right-box-sub1 {
            height: 100px;
            border-bottom: solid 2px rgba(81, 81, 81, 0.633);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            padding-left: 50px;
        }

        .right-box-sub1>h1 {
            font-size: 32px;
        }

        .right-box-sub2 {
            height: 380px;
            display: grid;
            justify-items: center;
            align-items: center;
            grid-template-columns: 1fr 1fr;
            font-weight: bold;
            color: rgba(13, 13, 13, 0.745);
            font-family: "Roboto", sans-serif;
        }

        .right-box-sub2>div {
            display: flex;
            flex-direction: column;
        }

        .right-box-sub2>div>input {
            border-radius: 5px;
            border: none;
            border-bottom: solid 2px rgba(0, 0, 0, 0.285);
            padding: 9px 12px;
            width: 250px;
            margin-top: 10px;
            font-weight: bold;
            color: rgba(13, 13, 13, 0.516);
        }

        .right-box-sub2>div>.btn {
            margin-top: 10px;
            font-size: 17px;
            font-weight: bold;
            width: 200px;
            padding: 9px 12px;
            border-radius: 5px;
            border: none;
            background-color: rgba(0, 208, 223, 0.878);
            color: rgba(13, 13, 13, 0.816);
        }

        .out {
            font-family: "Playwrite GB S", serif;
        }

        img {
            width: min-content;
        }
    </style>
</head>

<body>

    <section class="main">
        <section class="main-sub">

            <form name="addProfile" method="post" action="addPhoto.php" enctype="multipart/form-data">
                <div class="left-box">
                    <nav>
                        <div>
                            <div class="profile">

                            </div>
                        </div>
                        <div class="addPhoto">
                            <p class="data">
                                Vihaga12
                            </p>
                            <p class="data">
                                <?php if (isset($_SESSION["first-name"]) || isset($_SESSION["last-name"])) {
                                    echo $_SESSION["first-name"] . ' ' . $_SESSION["last-name"];
                                } ?>
                            </p>
                            <div>
                                <input type="file" name="file" class="btn0" required style="font-size: 13px;">
                                <button type="submit" class="btn1" style="width: 120px;" value="Upload Photo"
                                    name="submit">Save</button>
                            </div>
                        </div>

                    </nav>
                </div>
            </form>

            <div class="right-box">
                <div class="right-box-sub1">
                    <h1>Hi
                        <?php if (isset($_SESSION["first-name"]) || isset($_SESSION["last-name"])) {
                            echo "<b class='out'>" . $fname . ' ' . $lname . '.' . "<b>";
                        } ?>
                    </h1>
                </div>
                <form name="userData" method="post" action="profileFrom.php">
                    <div class="right-box-sub2">
                        <div>
                            <label for="fName">First Name</label>
                            <input type="text" id="fName" name="fName" value="<?php echo $fname; ?>" required>
                        </div>
                        <div>
                            <label for="lName">Last Name</label>
                            <input type="text" id="lName" name="lName" value="<?php echo $lname; ?>" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php if (isset($_SESSION["email"])) {
                                echo $_SESSION["email"];
                            } ?>" readonly>
                        </div>
                        <div>
                            <label for="phone">Telephone</label>
                            <input type="number" id="pass" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                        <div>
                            <label for="pass">New password</label>
                            <input type="text" id="pass" name="pass" value="<?php if (isset($_SESSION["password"])) {
                                echo $_SESSION["password"];
                            } ?>">
                        </div>
                        <div>
                            <label for="re-pass">Re-enter</label>
                            <input type="text" id="re-pass" name="re-pass" value="<?php if (isset($_SESSION["password"])) {
                                echo $_SESSION["password"];
                            } ?>">
                        </div>
                        <div>
                            <button type="submit" class="btn" name="submit">Save</button>
                        </div>
                        <div>
                            <button type="button" class="btn">Delete Account</button>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </section>

</body>

</html>