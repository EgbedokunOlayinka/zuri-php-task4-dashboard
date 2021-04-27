<?php
    if(isset($_POST['submit'])) {
        $courseInput = mysqli_real_escape_string($conn, $_POST['course']);

        $query = "INSERT INTO courses (name, user_id) VALUES ('$courseInput', $userId)";

        if(mysqli_query($conn, $query)) {
            $courseInput = '';

            $msg = 'Course added successfully';
            $msgClass = 'alert-success';
        } else {
            $msg = 'Action could not be completed';
            $msgClass = 'alert-danger';
        }
    }