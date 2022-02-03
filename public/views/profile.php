
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "public/css/home_page.css">
    <link rel="stylesheet" type="text/css" href="public/css/basic.css">
    <title>Profile</title>
</head>
<body>
<div class="base_profile_container">
    <?php include 'reusable/navigation_bar_transparent.php';?>
    <div class="main_window_profile">
        <div class="profile_info">
            <div class="personal_info">
                <div class="profile_top">
                    <div class="error_messages">
                        <?php
                        if(isset($messages)){
                            foreach ($messages as $message){
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <label class="personal_info_top">Profile info</label>
                </div>
                <?php $userRepository = new UserRepository();
                    $user = $userRepository->getUserByID($_COOKIE['user'])
                ?>
                <div class="user_info">
                    <div class="info">Name: <?php echo($user->getName())?></div>
                    <div class="info">Email: <?php echo($user->getEmail())?></div>
                    <div class="info">Role: <?php echo($user->getRole())?></div>
                </div>
            </div>
            <div class="profile_options">
                <form class="add_option" action="add_element" method="post">
                    <?php if(isset($_COOKIE['role']) and $_COOKIE['role'] == 'admin'){
                        include 'reusable/admin_option.php';
                    }?>
                </form>
                <form class="logout" action="logout" method="post">
                    <button class="logout-button" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>