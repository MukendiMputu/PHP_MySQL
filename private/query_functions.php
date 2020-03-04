<?php
    function find_all_subjects() {
        global $db;

        $sql = "SELECT * FROM subjects ";
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_pages() {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql .= "ORDER BY subject_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_page_by_id($page_id) {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE id ='" . $page_id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page;
    }

    function find_subject_by_id($subject_id) {
        global $db;

        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE id ='" . $subject_id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject;
    }

    function insert_subject($subject) {
        global $db;

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . $subject['menu_name'] . "',";
        $sql .= "'" . $subject['position'] . "',";
        $sql .= "'" . $subject['visible'] . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $new_id = mysqli_insert_id($db);
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function insert_page($page) {
        global $db;

        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, page_name, position, visible, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . $page['subject_id'] . "',";
        $sql .= "'" . $page['page_name'] . "',";
        $sql .= "'" . $page['position'] . "',";
        $sql .= "'" . $page['visible'] . "',";
        $sql .= "'" . $page['content'] . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $new_id = mysqli_insert_id($db);
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_subject($subject) {
        global $db;

        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name = '" . $subject['menu_name'] . "', ";
        $sql .= "position = '" . $subject['position'] . "', ";
        $sql .= "visible = '" . $subject['visible'] . "' ";
        $sql .= "WHERE id ='" . $subject['id'] . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function update_page($page) {
        global $db;

        $sql = "UPDATE pages SET ";
        $sql .= "subject_id = '" . $page['subject_id'] . "', ";
        $sql .= "page_name = '" . $page['page_name'] . "', ";
        $sql .= "position = '" . $page['position'] . "', ";
        $sql .= "visible = '" . $page['visible'] . "' ";
        $sql .= "WHERE id ='" . $page['id'] . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function delete_page($id) {
        global $db;

        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id ='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result) {
            return true;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function delete_subject($id) {
        global $db;

        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        // For DELETE statements, $result is true/false
        if($result) {
          return true;
        } else {
          // DELETE failed
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
    }

    function count_subject_records() {
        global $db;

        $sql = "SELECT COUNT(id) FROM subjects";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $result;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }

    }

    function count_page_records() {
        global $db;

        $sql = "SELECT COUNT(id) FROM pages";
        $result = mysqli_query($db, $sql);

        if($result) {
            return $result;
        } else {
          // INSERT failed: show error and close connexion
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }

    }
?>