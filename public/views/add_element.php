
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "public/css/home_page.css">
    <link rel="stylesheet" type="text/css" href="public/css/basic.css">
    <title>Profile</title>
</head>
<body>
<div class="add_element_container">
    <?php include 'reusable/navigation_bar_transparent.php';?>
    <div class="main_window_add_element">
        <form class="add_element_form" action="add_element_to_db" method="post">
            <label class="add_element_label">Add element to DB</label>
            <div class="add_element_buttons">
                <button type="button">
                    <a class=back-button href="profile">Back</a>
                </button>
                <button class="add_button" type="submit">Add</button>
            </div>
            <div class="add_element_menu">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                if(isset($_POST['book'])){
                    include 'reusable/book_includes.php';
                }
                elseif(isset($_POST['movie'])){
                    include 'reusable/movie_includes.php';
                }
                elseif(isset($_POST['series'])){
                    include 'reusable/series_includes.php';
                }
                ?>
            </div>

        </form>
    </div>
</div>
</body>
</html>