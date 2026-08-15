const statusFilter = document.getElementById("statusFilter");
const books = document.querySelectorAll("tbody tr.value");

statusFilter.addEventListener("change", function () {
  const selectedStatus = statusFilter.value;

  books.forEach(function (book) {
    const bookStatus = book.dataset.status;

    if (selectedStatus === "all" || bookStatus === selectedStatus) {
      book.style.display = "table-row";
    } else {
      book.style.display = "none";
    }
  });
});
