<div class="elements">
    <?php $library_repository = new LibraryRepository();
    foreach ($elements as $element):?>
        <div class="element-container">
            <?php
            $element_id = $element->getId();
            if($library_repository->inUserLibrary($element_id,$_COOKIE['user'])){
                $class="blue_circle";
                $icon ="white";
            }
            else{
                $class = "white_circle";
                $icon = "gray";
            }
            $path_to_icon = 'public/img/icons/'.$icon.'_'.$element->getType().'.svg';

            ?>
            <form class=<?php echo $class ?> action="change_state_of_element" method="post">
                <button name="button_element" class="circle_button" value=<?php echo $element_id?>>
                    <img class="small_icon" src=<?php echo $path_to_icon ?>>
                </button>
            </form>
            <form class="element" action="single_element" method="post">
                <div class="element_label" type="submit">
                    <button name="button_element2" value=<?php echo $element_id?> >
                        <?php echo $element->getOriginalTitle() ?>
                    </button>
                </div>
                <img src="public/uploads/placeholder.png" alt="placeholder">
            </form>
        </div>
    <?php endforeach; ?>
</div>