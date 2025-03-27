document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("imageInput");
    const addImageBtn = document.getElementById("addImageBtn");
    const previewContainer = document.getElementById("preview");
    const categorySelect = document.getElementById("category-select");
    const newCategoryContainer = document.getElementById("new-category-container");
    let selectedFiles = [];

    // Handle "Add Image" Button Click
    addImageBtn.addEventListener("click", () => {
        imageInput.click();
    });

    // Image Preview Functionality with multiple file support
    imageInput.addEventListener("change", (event) => {
        const files = Array.from(event.target.files);
        selectedFiles = selectedFiles.concat(files);

        // Remove duplicates by filtering unique file names
        selectedFiles = selectedFiles.filter((file, index, self) =>
            index === self.findIndex(f => f.name === file.name)
        );

        // Create a new DataTransfer object to store selected files
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files; // Assign to input

        updateImagePreview();
    });

    function updateImagePreview() {
        previewContainer.innerHTML = ""; // Clear previous previews
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgWrapper = document.createElement("div");
                imgWrapper.classList.add("relative", "w-20", "h-20");

                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("w-full", "h-full", "object-cover", "rounded-lg", "shadow");

                // Add remove button for each image
                const removeBtn = document.createElement("button");
                removeBtn.innerHTML = "&times;";
                removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "rounded-full", "w-5", "h-5", "flex", "items-center", "justify-center");
                removeBtn.addEventListener("click", () => removeImage(index));

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        selectedFiles.splice(index, 1);
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files; // Assign updated list
        updateImagePreview();
    }

    // Handle Category Selection
    categorySelect.addEventListener("change", function () {
        newCategoryContainer.classList.toggle("hidden", this.value !== "new");
    });
});
