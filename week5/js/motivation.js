const messages = [
    "Keep going.",
    "Small steps still count.",
    "Debugging is part of learning.",
    "Test, improve, repeat.",
    "You are building real skills."
];
document.getElementById("surpriseButton").addEventListener("click", function () {
        const randomIndex = Math.floor(Math.random() * messages.length);
        document.getElementById("messageOutput").innerHTML = messages[randomIndex];
    });