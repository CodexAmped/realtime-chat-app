<?php
session_start();
if(!isset($_SESSION["unique_id"])){
    header("location: login.php");
}
?>

<?php require_once "includes/header.php"; ?>
<body>
    <div class="container logged">
        <div class="wrapper">
            <section class="users">
                <header>
                    <?php
                        include_once "config/config.php";
                        $uniqueId = $_SESSION["unique_id"];
                        $query = $connect->prepare("SELECT * FROM users WHERE unique_id=:unique_id");
                        $query->bindParam(":unique_id", $uniqueId);
                        $query->execute();
                        
                        if($query->rowCount() > 0){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $firstName = $row["first_name"];
                            $lastName = $row["last_name"];
                            $status = $row["status"];
                            $image = $row["image"];
                        }
                    ?>
                    <div class="content">
                        <img src="assets/images/profile/<?php echo $image; ?>"alt="">
                        <div class="details">
                            <span><?php echo $firstName . " " . $lastName; ?></span>
                            <p><?php echo $status; ?></p>
                        </div>
                    </div>
                    <a href="includes/logout.php?logout_id=<?php echo $row["unique_id"] ?>" class="logout">Logout</a>
                </header>   
                <div class="search">
                    <span class="text">Select a user to start chat</span>
                    <input type="text" name="" id="" placeholder="Enter a name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list"></div>
            </section>
        </div>
    </div>
<script src="assets/js/users.js"></script>
</body>
</html>