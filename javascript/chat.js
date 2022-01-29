const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

// inputField.onsubmit=(e)=>{
//     e.preventDefault();
// } 

form.onsubmit = (e)=>{
    e.preventDefault();
} 

sendBtn.onclick = ()=>{
    // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    // we have to send the form data through AJAX to php
    let formData = new FormData(form);
    xhr.send(formData); //sending the form data to PHP
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add('active');
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove('active');
}

setInterval(()=>{
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains('active')){
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData); 
}, 500);


function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}