document.addEventListener("DOMContentLoaded", function () {
    const imageViewer = document.getElementById("image-viewer");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    let currentIndex = 0;
    let imagesData = [];
    let loadedImages = {};
    function loadXMLImages() {
        fetch("assets/IMGViewer/IMGViewer.xml")
            .then((response) => response.text())
            .then((xmlText) => {
                const parser = new DOMParser();
                const xml = parser.parseFromString(xmlText, "application/xml");
                const imageElements = xml.getElementsByTagName("image");
                for (let i = 0; i < imageElements.length; i++) {
                    imagesData.push({ src: imageElements[i].getElementsByTagName("src")[0].textContent, alt: imageElements[i].getElementsByTagName("alt")[0].textContent });
                }
                loadImage(0);
            })
            .catch((error) => console.error("Erreur de chargement du fichier XML : ", error));
    }
    function loadImage(index) {
        if (loadedImages[index]) {
            showImage(index);
            return Promise.resolve();
        }
        return new Promise((resolve, reject) => {
            const img = document.createElement("img");
            img.src = imagesData[index].src;
            img.alt = imagesData[index].alt;
            img.classList.add("carousel-images");
            img.onload = () => {
                loadedImages[index] = img;
                imageViewer.appendChild(img);
                showImage(index);
                resolve();
            };
            img.onerror = reject;
        });
    }
    function showImage(index) {
        for (let key in loadedImages) {
            loadedImages[key].classList.remove("active");
        }
        if (loadedImages[index]) {
            loadedImages[index].classList.add("active");
        }
    }
    function preloadNextImage(index) {
        const nextIndex = index === imagesData.length - 1 ? 0 : index + 1;
        if (!loadedImages[nextIndex]) {
            loadImage(nextIndex);
        }
    }
    function preloadPrevImage(index) {
        const prevIndex = index === 0 ? imagesData.length - 1 : index - 1;
        if (!loadedImages[prevIndex]) {
            loadImage(prevIndex);
        }
    }
    prevButton.addEventListener("click", async () => {
        const newIndex = currentIndex === 0 ? imagesData.length - 1 : currentIndex - 1;
        await loadImage(newIndex);
        currentIndex = newIndex;
        preloadPrevImage(currentIndex);
    });
    nextButton.addEventListener("click", async () => {
        const newIndex = currentIndex === imagesData.length - 1 ? 0 : currentIndex + 1;
        await loadImage(newIndex);
        currentIndex = newIndex;
        preloadNextImage(currentIndex);
    });
    loadXMLImages();
});
