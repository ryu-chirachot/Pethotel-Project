function previewImage(input, id) {
    const previewId = `previewImage${id}`;
    const previewImage = document.getElementById(previewId);
    const container = input.parentElement;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            container.classList.remove('empty');
        }
        reader.readAsDataURL(input.files[0]);
    }
}






// function previewImage(input) {
//     const container = input.parentElement;
//     if (input.files && input.files[0]) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             container.innerHTML = `<img src="${e.target.result}">`;
//             container.appendChild(input);
//             container.classList.remove('empty');
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }

// function previewImages(input) {
//     const previewContainer = document.getElementById('imagePreview');
//     previewContainer.innerHTML = ''; // เคลียร์รูปภาพเก่าออก
//     if (input.files) {
//         Array.from(input.files).forEach((file, index) => {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const imgContainer = document.createElement('div');
//                 imgContainer.className = 'col-4 mb-3'; // ใช้ Bootstrap เพื่อแบ่งเป็น 3 รูปต่อแถว
//                 imgContainer.innerHTML = `<img src="${e.target.result}" class="img-fluid" />`;
//                 previewContainer.appendChild(imgContainer);
//             }
//             reader.readAsDataURL(file);
//         });
//     }
// }
