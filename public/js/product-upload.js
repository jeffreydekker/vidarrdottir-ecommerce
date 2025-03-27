document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("imageInput");
    const addImageBtn = document.getElementById("addImageBtn");
    const previewContainer = document.getElementById("preview");
    const categorySelect = document.getElementById("category-select");
    const newCategoryContainer = document.getElementById("new-category-container");

    // Handle "Add Image" Button Click
    addImageBtn.addEventListener("click", () => {
        imageInput.click();
    });

    // Image Preview Functionality
    imageInput.addEventListener("change", (event) => {
        const files = event.target.files;
        previewContainer.innerHTML = ""; // Clear previous previews

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("w-20", "h-20", "object-cover", "rounded-lg", "shadow");
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // Handle Category Selection
    categorySelect.addEventListener("change", function () {
        newCategoryContainer.classList.toggle("hidden", this.value !== "new");
    });
});
