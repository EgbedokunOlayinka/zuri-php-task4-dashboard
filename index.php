<?php
    include('inc/header.php');
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
    };

    $msg = '';
    $msgClass = '';
    $user;
    $userId;
    $email = $_SESSION['email'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $num_row = mysqli_num_rows($result);

    if($num_row > 0) {
        $fetched = mysqli_fetch_assoc($result);
        $user = $fetched;
        $userId = $user['id'];

        require('add.php');
        require('delete.php');


        $course_query = "SELECT * FROM courses WHERE user_id=$userId  ORDER BY created_at DESC";
        $course_result = mysqli_query($conn, $course_query);
        $courses = mysqli_fetch_all($course_result, MYSQLI_ASSOC);

        // echo($courses[0]['name']);
    } else {
        header('Location: login.php');
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

        <h2 class='text-center'>Welcome</h2>
        <p class="text-center">
            <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
        </p> 

        <form action="" method='POST'>
            <div class="my-3">
                    <label class="form-label">Add Course</label>
                    <input required type="text" class="form-control" name='course' value="<?php echo isset($_POST['course']) ? $courseInput : ''; ?>">
                    <input class="btn btn-primary w-100 mt-3" type='submit' name='submit' value='Submit'>
            </div>

            <div class='my-5'>
                <h4>Your Courses</h4>
                <table class="table table-responsive align-middle">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($courses as $key=>$course) : ?>
                        <tr>
                            <th scope="row"><?php echo $key+1; ?></th>
                            <td><?php echo $course['name']; ?></td>
                            <td>
                                <a class='btn btn-primary' href="edit.php?id=<?php echo $course['id']; ?>">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='delete_id' value="<?php echo $course['id']; ?>" />
                                    <input type='submit' name='delete' value='Delete' class='btn btn-danger' />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<?php
    include('inc/footer.php');
?>