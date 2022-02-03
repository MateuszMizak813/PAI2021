

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "public/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo_login.svg" alt="Logo">
        </div>
        <div class="login-box">
            <form class="login-input" id="login1" action="login" method="POST">
                <div class="error_messages">
                    <?php
                    if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email@mail.com">
                <input name="password" type="password" placeholder="password">
            </form>
            <div class="login-buttons">
                <div class="login">
                    <button type="submit" form="login1">Login</button>
                </div>
                <div class="sign-up">
                        <button>
                            <a class="sign-up-button" href="signup">Sign Up</a>
                        </button>
                </div>
            </div>
        </div>
        <div class="picture_1">
            <img src="public/img/login_pic_1.svg" alt="picture_1">
        </div>
        <div class="picture_2">
            <img src="public/img/login_pic_2.svg" alt="picture2">
        </div>
    </div>
</body>
</html>