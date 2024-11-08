function editText(elementId) {
    const element = document.getElementById(elementId);
    const originalText = element.innerText;
    const sectionName = element.getAttribute("id");
    const textarea = document.createElement("textarea");
    textarea.value = originalText;
    element.replaceWith(textarea);
    const saveButton = document.createElement("button");
    saveButton.innerText = "Sauvegarder";
    textarea.after(saveButton);
    saveButton.addEventListener("click", function () {
        const newText = textarea.value;
        console.log(sectionName);
        fetch("?controller=home&action=updateText", { method: "POST", headers: { "Content-Type": "application/x-www-form-urlencoded" }, body: new URLSearchParams({ section_name: sectionName, text: newText }) })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    const newParagraph = document.createElement("p");
                    newParagraph.id = elementId;
                    newParagraph.innerText = newText;
                    textarea.replaceWith(newParagraph);
                    saveButton.remove();
                } else {
                    alert("Erreur lors de la mise à jour");
                }
            });
    });
}
