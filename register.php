<?php
    include('inc/header.php');

    if (isset($_SESSION['email'])) {
        header('Location: index.php');
    };

    $msg = '';
    $msgClass = '';

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
   
        if (!empty($email) && !empty($password) && !empty($confirm)) {
            if ($password === $confirm) {
                $query = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $query);
                $num_row = mysqli_num_rows($result);
                mysqli_free_result($result);

                if($num_row > 0) {
                    $msg = 'User exists. Please try a new email';
                    $msgClass = 'alert-danger';
                } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);

                    $query = "INSERT INTO users (email, first_name, last_name, password) VALUES ('$email', '$first_name', '$last_name', '$hashed')";

                    if(mysqli_query($conn, $query)) {
                        $msg = 'Registration successful';
                        $msgClass = 'alert-success';

                        $email = '';
                        $first_name = '';
                        $last_name = '';
                        $password = '';
                        $confirm = '';
                    } else {
                        $msg = 'Registration could not be completed';
                        $msgClass = 'alert-danger';
                    }
                };
            } else {
                $msg = 'Passwords do not match';
                $msgClass = 'alert-danger';
            };
        } else {
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        };
    };
?>

<div class="container my-3">
        <div class="box py-3 mx-auto">
            <h2 class='text-center'>Register</h2> 

            <?php if ($msg !== ''): ?>
                <div class="alert alert-dismissible fade show <?php echo $msgClass; ?>">
                    <strong><?php echo $msg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="" method='POST'>
                <div class="my-4">
                    <label class="form-label">Email address</label>
                    <input required type="email" class="form-control" name='email' value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                </div>

                <div class="my-4">
                    <label class="form-label">First name</label>
                    <input required type="text" class="form-control" name='first_name' value="<?php echo isset($_POST['first_name']) ? $first_name : ''; ?>">
                </div>

                <div class="my-4">
                    <label class="form-label">Last name</label>
                    <input required type="text" class="form-control" name='last_name' value="<?php echo isset($_POST['last_name']) ? $last_name : ''; ?>">
                </div>

                <div class="my-4">
                    <label class="form-label">Password</label>
                    <input required minlength='4' type="password" class="form-control" name='password' value="<?php echo isset($_POST['password']) ? $password : ''; ?>">
                </div>

                <div class="my-4">
                    <label class="form-label">Confirm Password</label>
                    <input required minlength='4' type="password" class="form-control" name='confirm' value="<?php echo isset($_POST['confirm']) ? $confirm : ''; ?>">
                </div>

                <div style='margin-top: 3rem'>
                    <input class="btn btn-primary w-100" type='submit' name='submit' value='Submit'>
                </div>
            </form>
        
        </div>
</div>

<?php
    include('inc/footer.php');
?>