
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "public/css/home_page.css">
    <title>Home</title>
</head>
<body>
    <div class="home_page_container">
        <div class="main_bar">
            <div class="logo">
                <div class="logo_pic">
                    <img src="public/img/logo_book.svg" alt="logo_book">
                </div>
                <div class="logo_text">
                    <img src="public/img/logo_text.svg" alt="logo_text">
                </div>
            </div>
            <div class="menu">
                <div class="home">
                    <div class="home_icon">
                        <img src="public/img/icons/home_icon.svg" alt="home_icon">
                    </div>
                    <button class="home_button">
                        <a class="to-home" href="home">Home</a>
                    </button>
                </div>
                <div class="library">
                    <div class="library_icon">
                        <img src="public/img/icons/library_icon.svg" alt="library_icon">
                    </div>
                    <button class="library_button">
                        <a class="to-library" href="library">Library</a>
                    </button>
                </div>
                <div class="profile">
                    <div class="profile_icon">
                        <img src="public/img/icons/profile_icon.svg" alt="profile_icon">
                    </div>
                    <button class="profile_button">
                        <a class="to-profile" href="profile">Profile</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="search_text">
            Search for your favourite books and movies
        </div>
        <div class="search_bar">
            <form class="search_form" action="searchResults" method="post">
                <div class="search_button">
                    <button type="submit">
                        <img class="search_icon" src="public/img/icons/search_icon.svg" alt="home_search_icon">
                    </button>
                </div>
                <div class="search_input">
                    <input name="search" type="text">
                </div>
            </form>
        </div>
        <div class="home_page_pic_1">
            <img src="public/img/home_page_pic_1.svg" alt="home_pic_1">
        </div>
        <div class="home_page_pic_2">
            <img src="public/img/home_page_pic_2.svg" alt="home_pic_2">
        </div>
    </div>
</body>
</html>