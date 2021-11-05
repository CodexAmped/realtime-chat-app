<?php
session_start();
if(isset($_SESSION["unique_id"])){
    header("Location: users.php");
}
?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container main" id="particles-js">
        <div class="wrapper">
            <section class="form signup">
                <header>Realtime Chat Application</header>
                <form action="" enctype="multipart/form-data">
                    <div class="error-txt"></div>
                    <div class="name-details">
                        <div class="field input">
                            <label>First Name</label>
                            <input type="text" name="first_name" id="" placeholder="First Name" required>
                        </div>
                        <div class="field input">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter new password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Select Image</label>
                        <input type="file" name="profile_image">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Contiinue to chat">
                    </div>
                </form>
                <div class="link">Already signed up? <a href="login.php">Login now</a></div>
            </section>
        </div>
    </div>
<script src="assets/js/password-actions.js"></script>
<script src="assets/js/sign-up.js"></script>
<script type="text/javascript" src="assets/js/particles.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>