<?php
    include('inc/header.php');

    if (isset($_SESSION['email'])) {
        header('Location: index.php');
    };

    $msg = '';
    $msgClass = '';

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
   
        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            $num_row = mysqli_num_rows($result);

            if($num_row > 0) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {
                    $_SESSION["email"] = $email;
            
                    $email = '';
                    $password = '';

                    header('Location: index.php');
                } else {
                    $msg = 'Incorrect user details. Check and try again';
                    $msgClass = 'alert-danger';
                }

                mysqli_free_result($result);
            } else {
                $msg = 'Incorrect user details. Check and try again';
                $msgClass = 'alert-danger';
            }
        } else {
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        };
    };
?>

<div class="container my-3">
        <div class="box py-3 mx-auto">
            <h2 class='text-center'>Login</h2> 

            <?php if ($msg !== ''): ?>
                <div class="alert alert-dismissible fade show <?php echo $msgClass; ?>">
                    <strong><?php echo $msg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="" method='POST'>
                <div class="my-4">
                    <label class="form-label">Email address</label>
                    <input required type="email" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                </div>
                <div class="my-4">
                    <label class="form-label">Password</label>
                    <input required minlength='4' type="password" class="form-control" name='password' value="<?php echo isset($_POST['password']) ? $password : ''; ?>">
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