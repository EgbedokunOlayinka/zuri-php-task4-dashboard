<?php
    include('inc/header.php');
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
    };

    $courseName = '';
    $msg = '';
    $msgClass = '';

    if(isset($_POST['submit'])) {
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        $courseId = mysqli_real_escape_string($conn, $_GET['id']);

        $query = "UPDATE courses SET name='$course' WHERE id=$courseId";

        if (mysqli_query($conn, $query)) {
            $courseName = '';

            header('Location: dashboard.php');
        } else {
            $msg = 'Action could not be completed';
            $msgClass = 'alert-danger';
        };
    };

    if($_GET['id']) {
        $courseId = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM courses WHERE id='$courseId'";
        $result = mysqli_query($conn, $query);
        $num_row = mysqli_num_rows($result);

        if($num_row > 0) {
            $course = mysqli_fetch_assoc($result);
            $courseName = $course['name'];
        } else {
            header('Location: dashboard.php');
        }
    }

    
?>

<div class="container my-3">
    <div class="box py-3 mx-auto">
            <?php if ($msg !== ''): ?>
                <div class="alert alert-dismissible fade show <?php echo $msgClass; ?>">
                    <strong><?php echo $msg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

        <form action="" method='POST'>
            <div class="my-3">
                    <label class="form-label">Course Name</label>
                    <input required type="text" class="form-control" name='course' value="<?php echo isset($courseName) ? $courseName : ''; ?>">
                    <input class="btn btn-primary w-100 mt-3" type='submit' name='submit' value='Submit'>
            </div>
        </form>
    </div>
</div>

<?php
    include('inc/footer.php');
?>