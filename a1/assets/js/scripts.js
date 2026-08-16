//Book Filter
const statusFilter = document.getElementById("statusFilter");
const books = document.querySelectorAll("tbody tr.value");

if (statusFilter) {
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
}

//Gallery Modal 
const galleryImages = document.querySelectorAll(
  ".gallery-image-button"
);

const modalImage = document.getElementById("modalImage");
const modalTitle = document.getElementById("imageModalLabel");
const galleryModalElement = document.getElementById("imageModal");

const previousButton = document.querySelector(
  ".previous-button"
);

const nextButton = document.querySelector(
  ".next-button"
);

let currentImageIndex = 0;

if (galleryImages.length > 0 &&
  modalImage &&
  modalTitle &&
  galleryModalElement) {

  const galleryModal = new bootstrap.Modal(
    galleryModalElement
  );

  function showImage(index) {
    currentIndex = index;

    const image = galleryImages[currentIndex];
    const imagePath = image.dataset.image;
    const imageTitle = image.dataset.title;
    const imageAlt = image.querySelector("img").alt;

    modalImage.src = imagePath;
    modalImage.alt = imageAlt;
    modalTitle.textContent = imageTitle;
  }

  galleryImages.forEach(function (image, index) {
    image.addEventListener("click", function () {
      currentIndex = index;
      showImage(currentIndex);
      galleryModal.show();
    });
  });

  previousButton.addEventListener("click", function () {
    currentIndex = currentIndex - 1;

    if (currentIndex < 0) {
      currentIndex = galleryImages.length - 1;
    }

    showImage(currentIndex);
  });

  nextButton.addEventListener("click", function () {
    currentIndex = currentIndex + 1;

    if (currentIndex >= galleryImages.length) {
      currentIndex = 0;
    }

    showImage(currentIndex);
  });
}
