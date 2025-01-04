document.getElementById("media").addEventListener("change", function() {
    var fileName = this.files[0] ? this.files[0].name : "No file selected";
    document.getElementById("file-name").textContent = "Selected file: " + fileName;
});
