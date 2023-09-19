function getLinkImg(){
    const myImage = document.getElementById("anhSP");
    const imagePreview = document.getElementById("imagePreview");
    const selectedImage = myImage.files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function(event) {
        imagePreview.src = event.target.result;
    });

    reader.readAsDataURL(selectedImage);
}
function getLinkImgs() {
  const input = document.getElementById('anhSPs');
  const galleryContainer = document.getElementById('ListAnhPhu')

  // Lặp qua các tệp được chọn
  for (let i = 0; i < input.files.length; i++) {
    const file = input.files[i];
    const reader = new FileReader();

    reader.addEventListener("load", function(event) {
      const image = document.createElement('img');
      image.src = event.target.result;
      galleryContainer.appendChild(image);
    });

    reader.readAsDataURL(file);
  }
}
