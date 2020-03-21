<?php
    require_once('../../../private/initialize.php');
    require_login();

    $page_title = 'Create Page';
?>

<?php include(SHARED_PATH .'/staff_header.php'); ?>

<?php

    if(is_post_request()) {

        // Handle form values sent by new.php
        $page = [];
        $page['page_name'] = $_POST['page_name'] ?? '';
        $page['subject_id'] = $_POST['subject_id'] ?? '';
        $page['position'] = $_POST['position'] ?? '';
        $page['visible'] = $_POST['visible'] ?? '';
        $page['content'] = $_POST['content'] ?? '';

        $result = insert_page($page);
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));

    } else {

        $subject_set = find_all_subjects();
        $subjects = mysqli_fetch_all($subject_set);

        $page_set = find_all_pages();
        $page_count = mysqli_num_rows($page_set) + 1;

        $page = [];
        $page['position'] = $page_count;
    }

?>

<div id="content">
    <a class="back list" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a><br/>

    <div class="page new">
        <h1>Create Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <dl>
                <dt>Page Name</dt>
                <dd><input type="text" name="page_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd>
                <select name="subject_id">
                        <?php
                        foreach($subjects as $subject_row) {
                            echo "<option value=\"{$subject_row[0]}\">{$subject_row[1]}</option>";
                        }
                        ?>
                </select>
                </dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                <select name="position">
                        <?php
                        for($i=1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($page["position"] == $i) {
                            echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                </select>
                </dd>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <dl>
                <dt>Page Content</dt>
                <dd><textarea name="content" cols="60" rows="10"></textarea></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Page" />
            </div>
        </form>
    </div>
</div>

<?php
    mysqli_free_result($subject_set);
    mysqli_free_result($page_set);
?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>