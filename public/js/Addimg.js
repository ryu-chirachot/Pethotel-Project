function previewImage(input) {
    const container = input.parentElement;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            container.innerHTML = `<img src="${e.target.result}">`;
            container.appendChild(input);
            container.classList.remove('empty');
        }
        reader.readAsDataURL(input.files[0]);
    }
}