document.getElementById("userForm").addEventListener("submit", function (event) {
  event.preventDefault();
  const name = document.getElementById("username").value;
  const email = document.getElementById("email").value;

  console.log("Name:", name);
  console.log("Email:", email);

  const msgDiv = document.getElementById("msg");
  msgDiv.innerHTML = `<p><strong>Name:</strong> ${name}</p><p><strong>Email:</strong> ${email}</p>`;
});
