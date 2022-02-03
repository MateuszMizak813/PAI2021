<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "public/css/login.css">
    <title>Sign Up</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo_login.svg" alt="Logo">
    </div>
    <div class="signup-box">
        <form class="signup-input" action="signup" method="POST">
            <div class="error_messages">
                <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email@mail.com">
            <input name="password1" type="password" placeholder="password">
            <input name="password2" type="password" placeholder="repeat password">
            <div class="login-buttons">
                <div class="back">
                    <button type="button">
                        <a class=back-button href="login">Back</a>
                    </button>
                </div>
                <div class="sign-up">
                    <button type="submit">Sign Up</button>
                </div>
            </div>
        </form>
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