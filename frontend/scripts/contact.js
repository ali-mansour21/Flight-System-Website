function sendMessage() {
    const chat = document.getElementById("chat-box");
      let userInput = document.getElementById("user-input").value;
      if (userInput.trim() !== "") {
        let userBubble = document.createElement("div");
        userBubble.classList.add("chat-bubble", "user-bubble");
        userBubble.innerHTML = `<p class="txt-grey-24">${userInput}</p>`;
        chat.appendChild(userBubble);
        document.getElementById("user-input").value = "";
      }
}
