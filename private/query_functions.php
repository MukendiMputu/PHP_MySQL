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

    function insert_subject($menu_name, $position, $visible) {
        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . $menu_name . "',";
        $sql .= "'" . $position . "',";
        $sql .= "'" . $visible . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            $new_id = mysqli_insert_id($db);
            redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function insert_page($page_name, $position, $visible) {
        $sql = "INSERT INTO pages ";
        $sql .= "(page_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . $page_name . "',";
        $sql .= "'" . $position . "',";
        $sql .= "'" . $visible . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
            $new_id = mysqli_insert_id($db);
            redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
        } else {
            // INSERT failed: show error and close connexion
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
?>