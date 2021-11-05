const signupForm = document.querySelector(".signup form");
const continueButton = signupForm.querySelector(".button input");
const errorText = signupForm.querySelector(".error-txt");

signupForm.onsubmit = e => {
    e.preventDefault();
}
continueButton.onclick = () => {
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("POST", "ajax/signUp.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                }
                else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //Send the form data through ajax to php
    let formData = new FormData(signupForm); //New formData object
    xhr.send(formData);
}
function readURL(input) {

    var property = document.querySelector('.video_input').files[0];
    var file_size = property.size;

    if(file_size > 500000000) {

        alert("Audio file size is very big");
    }
    else {

        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#add_video').css("display", "block");
                $('#add_video').attr('src', e.target.result).width(400);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}
