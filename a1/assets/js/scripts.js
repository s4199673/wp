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

//Add Book Form 
const addBook = document.getElementById("addBook");
const imageInput = document.getElementById("image_path");
const imagePreview = document.getElementById("imagePreview");
const errorMsg = document.getElementById("errorMsg");
const selectedFileName = document.getElementById("selectedFileName");

if (addBook) {
  const allowedImageTypes =
    /\.(jpg|jpeg|png|gif|webp)$/i;

    imageInput.addEventListener("change", function () {
    const selectedFile = imageInput.files[0];

    if (!selectedFile) {
      selectedFileName.textContent = "";
        imagePreview.src = "";
        imagePreview.classList.add("d-none");
        return;
    }

    if (allowedImageTypes.test(selectedFile.name)) {
      selectedFileName.textContent =
            "Selected: " + selectedFile.name;
        imagePreview.src = URL.createObjectURL(selectedFile);
        imagePreview.classList.remove("d-none");
        errorMsg.textContent = "";
    } else {
      selectedFileName.textContent = "";
        imageInput.value = "";
        imagePreview.src = "";
        imagePreview.classList.add("d-none");
        errorMsg.textContent =
            "Only JPG, JPEG, PNG, GIF and WEBP files are allowed.";
    }
});

addBook.addEventListener("submit", function (event) {
    event.preventDefault();

    const selectedFile = imageInput.files[0];
    let message = "";

    if (!selectedFile) {
        message = "Please select a cover image.";
    } else if (!allowedImageTypes.test(selectedFile.name)) {
        message =
            "Only JPG, JPEG, PNG, GIF and WEBP files are allowed.";
    } else {
        message = "Form is valid. No data has been submitted.";
    }

    errorMsg.textContent = message;
});
}