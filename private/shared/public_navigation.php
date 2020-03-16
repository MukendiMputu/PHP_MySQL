<navigation>
    <?php $nav_subjects = find_all_subjects(['visible' => true]); ?>
    <ul class="subjects">
        <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
        <li class="<?php echo $nav_subject['id'] == $subject_id ? 'selected' : '' ?>">
            <a href="<?php echo url_for('index.php?subject_id=' . h(u($nav_subject['id']))); ?>" > <?php echo h($nav_subject['menu_name']);?> </a>
            <?php
                if($nav_subject['id'] == ($subject_id ?? '')) {
                 $nav_pages = find_pages_by_subject_id($nav_subject['id'], ['visible' => true]); ?>
                <ul class="pages">
                    <?php while($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
                    <li class="<?php echo $nav_page['id'] == $page_id ? 'selected' : '' ?>">
                        <a href="<?php echo url_for('index.php?id=' . h(u($nav_page['id']))); ?>" > <?php echo h($nav_page['page_name']);?> </a>
                    </li>
                    <?php } // end of while($nav_page ?>
                </ul>
                <?php mysqli_free_result($nav_pages);?>
            <?php } ?>
        </li>
        <?php } // end of while($nav_subject ?>
    </ul>
    <?php mysqli_free_result($nav_subjects);?>
</navigation>
