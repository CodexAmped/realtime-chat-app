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
            <section class="chat-area">
                <header>
                    <?php
                        include_once "config/config.php";
                        $user_id = $_GET["user_id"];
                        $query = $connect->prepare("SELECT * FROM users WHERE unique_id=:unique_id");
                        $query->bindParam(":unique_id", $user_id);
                        $query->execute();
                        
                        if($query->rowCount() > 0){
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                            $firstName = $row["first_name"];
                            $lastName = $row["last_name"];
                            $status = $row["status"];
                            $image = $row["image"];
                            $uniqueId = $_SESSION["unique_id"];
                        }
                    ?>
                    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="assets/images/profile/<?php echo $image; ?>" alt="">
                    <div class="details">
                        <span><?php echo $firstName . " " . $lastName; ?></span>
                        <p><?php echo $status; ?></p>
                    </div>
                </header>
                <div class="chat-box"></div>
                <form action="#" class="typing-area" autocomplete="off">
                    <input type="text" name="outgoing_id" value="<?php echo $_SESSION["unique_id"]; ?>" hidden>
                    <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>  
            </section>
        </div>
    </div>
    <script src="assets/js/chats.js"></script>
</body>
</html>