document.getElementById("registerForm").addEventListener("submit", function(event) {
  event.preventDefault();
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const age = parseInt(document.getElementById("age").value, 10);
  const msg = document.getElementById("msg");
  msg.innerHTML = "";

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!name || !email || isNaN(age)) {
    msg.innerHTML = "All fields are required.";
    return;
  }
  if (!emailPattern.test(email)) {
    msg.innerHTML = "Invalid email format.";
    return;
  }
  if (age < 18 || age > 99) {
    msg.innerHTML = "Age must be between 18 and 99.";
    return;
  }

  msg.style.color = "green";
  msg.innerHTML = "Form submitted successfully!";
});
