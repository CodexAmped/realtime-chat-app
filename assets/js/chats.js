const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendButton = form.querySelector("button");
chatBox = document.querySelector(".chat-box");

form.onsubmit = e => {
    e.preventDefault();
}

sendButton.onclick = () => {
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("POST", "ajax/insert-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    //Send the form data through ajax to php
    let formData = new FormData(form); //New formData object
    xhr.send(formData);
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}
setInterval(() => {
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("POST", "ajax/load-chats.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }
    //Send the form data through ajax to php
    let formData = new FormData(form); //New formData object
    xhr.send(formData);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}