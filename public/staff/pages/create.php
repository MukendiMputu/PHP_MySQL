<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php
  $page = [];
  $page['page_name'] = $_POST['page_name'] ?? '';
  $page['subject_id'] = $_POST['subject_id'] ?? '';
  $page['position'] = $_POST['position'] ?? '';
  $page['visible'] = $_POST['visible'] ?? '';
  $page['content'] = $_POST['content'] ?? '';

  $new_id = insert_page($page);
  redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));

} else {
  redirect_to(url_for('/staff/pages/new.php'));
}

?>
