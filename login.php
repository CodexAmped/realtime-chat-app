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
            <section class="form login">
                <header>Realtime Chat Application</header>
                <form action="">
                    <div class="error-txt"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" id="" placeholder="Enter your email address">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" id="" placeholder="Enter your password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Contiinue to chat">
                    </div>
                </form>
                <div class="link">Not yet signed up? <a href="index.php">signup now</a></div>
            </section>
        </div>
    </div>
    
<script src="assets/js/password-actions.js"></script>
<script src="assets/js/login.js"></script>
<script type="text/javascript" src="assets/js/particles.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>