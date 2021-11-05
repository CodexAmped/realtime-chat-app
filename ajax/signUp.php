<?php 
session_start();
include_once "../config/config.php";

$firstName = $_POST["first_name"];
$lastName = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];

if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $query = $connect->prepare("SELECT email from users WHERE email=:email");
        $query->bindParam(":email", $email);
        $query->execute();
        if($query->rowCount() > 0){
            echo "$email - This email already exist!";
        }
        else{
            if(isset($_FILES["profile_image"])){
                $imageName = $_FILES['profile_image']['name'];
                $imageTmpName = $_FILES['profile_image']['tmp_name'];

                $imageExplode = explode(".", $imageName);
                $imageExt = end($imageExplode);
                
                $lowercasedExt = strtolower($imageExt);
                $extensions = ['png', 'jpeg', 'jpg'];
                
                if(in_array($lowercasedExt, $extensions) === true){
                    $time = time();

                    $directory = "../assets/images/profile/";

                    $newImageName = $time.$imageName;
                    $finalDirectory = $directory.$newImageName;

                    if(move_uploaded_file($imageTmpName, $finalDirectory)){
                        $status = "Active now";
                        
                        $uniqueId = rand(time(), 10000000);

                        $sql = $connect->prepare("INSERT INTO users (unique_id, first_name, last_name, email, password, image, status)
                                                    VALUES (:unique_id, :first_name, :last_name, :email, :password, :image, :status)");
                        $sql->bindParam(":unique_id", $uniqueId);
                        $sql->bindParam(":first_name", $firstName);
                        $sql->bindParam(":last_name", $lastName);
                        $sql->bindParam(":email", $email);
                        $sql->bindParam(":password", $password);
                        $sql->bindParam(":image", $newImageName);
                        $sql->bindParam(":status", $status);
                        $sql->execute();

                        if($sql){
                            $sql2 = $connect->prepare("SELECT * FROM users WHERE email=:email");
                            $sql2->bindParam(":email", $email);
                            $sql2->execute();
                            if($sql2->rowCount() > 0){
                                $row = $sql2->fetch(PDO::FETCH_ASSOC);
                                $_SESSION["unique_id"] = $row["unique_id"];
                                echo "success";
                            }
                        }
                    }
                }
                else{
                    echo "Please select an Image file - png, jpg, jpeg!";
                }
            }
            else{
                echo "Please select an Image file";
            }
        }
    }
    else{
        echo "$email - This email is invalid!";
    }
} 
else{
    echo "All field are required!";
}
?>