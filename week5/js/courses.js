const statusFilter = document.getElementById("statusFilter");
const courses = document.querySelectorAll(".course"); //array of class=course elements

statusFilter.addEventListener("change", function () {
    const selectedStatus = statusFilter.value;
    courses.forEach(function (course) {
        const courseStatus = course.dataset.status;
        if (selectedStatus === "all" || courseStatus === selectedStatus) {
            //course.style.display = "inline-block";
course.style.opacity = "1";

        } else {
            //course.style.display = "none";
            course.style.opacity = "0.2";
        }
    });
});