<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php

  $page_name = $_POST['page_name'] ?? '';
  $position = $_POST['position'] ?? '';
  $visible = $_POST['visible'] ?? '';

  $result = insert_subject($page_name, $position, $visible);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));

} else {
  redirect_to(url_for('/staff/pages/new.php'));
}

?>
