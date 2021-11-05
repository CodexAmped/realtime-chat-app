const signupForm = document.querySelector(".login form");
const continueButton = signupForm.querySelector(".button input");
const errorText = signupForm.querySelector(".error-txt");

signupForm.onsubmit = e => {
    e.preventDefault();
}
continueButton.onclick = () => {
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("POST", "ajax/login.php", true);
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