const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  imageInput = form.querySelector('input[type="file"]'),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box"),
  dropdownToggle = document.getElementById("dropdownToggle"),
  dropdownMenu = document.getElementById("dropdownMenu"),
  deleteOption = document.querySelector(".delete-option");

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
  if (inputField.value != "" || imageInput.files.length > 0) {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

imageInput.onchange = () => {
  if (inputField.value != "" || imageInput.files.length > 0) {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        imageInput.value = ""; // Clear the file input after sending the message
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

// Dropdown functionality
document.addEventListener("DOMContentLoaded", function() {
  dropdownToggle.addEventListener("click", function(event) {
    event.preventDefault();
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
  });

  // Close the dropdown if the user clicks outside of it
  document.addEventListener("click", function(event) {
    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.style.display = "none";
    }
  });

  deleteOption.addEventListener("click", function() {
    const userConfirmation = confirm("Are you sure you want to delete this chat?");
    if (userConfirmation) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/delete-chat.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            if (xhr.responseText === "success") {
              chatBox.innerHTML = ""; // Clear the chat box after deletion
            } else {
              alert("An error occurred while deleting the chat.");
            }
          }
        }
      };
      xhr.send("incoming_id=" + incoming_id);
    }
  });
});
