<?php
    if(isset($_POST['delete'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "DELETE FROM courses WHERE id = $delete_id";

        if (mysqli_query($conn, $query)) {
            $msg = 'Course deleted successfully';
            $msgClass = 'alert-success';
        } else {
            $msg = 'Action could not be completed';
            $msgClass = 'alert-danger';
        };
    };