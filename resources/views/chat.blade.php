<div id="chatbox" style="border:1px solid #ccc; width:300px; height:400px; overflow:auto; padding:10px;"></div>
<input id="userInput" type="text" placeholder="Type a message..." style="width:240px;">
<button onclick="sendMessage()">Send</button>

<script>
async function sendMessage() {
    let input = document.getElementById('userInput');
    let message = input.value;
    if (!message) return;

    let chatbox = document.getElementById('chatbox');
    chatbox.innerHTML += "<div><b>You:</b> " + message + "</div>";

    let res = await fetch("/chatbot", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: JSON.stringify({ message })
    });
    let data = await res.json();

    chatbox.innerHTML += "<div><b>Bot:</b> " + data.reply + "</div>";
    input.value = "";
    chatbox.scrollTop = chatbox.scrollHeight;
}
</script>
