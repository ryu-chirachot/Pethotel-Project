document.addEventListener("DOMContentLoaded", ()=> {
    const roomsButton = document.getElementById("roomsButton");
    const roomSubMenu = document.getElementById("roomSubMenu");

    // ซ่อน โชว์ Dropdown เพิ่ม,แก้ไข
    roomsButton.addEventListener("click", ()=> {
        roomSubMenu.style.display = roomSubMenu.style.display === "none" ? "block" : "none";
    });

    // เงื่อนไขถ้ามีการกดที่เพิ่ม,แก้ไขของห้องพัก ให้ห้องพักเปลี่ยน css ด้วย
    const activeRoomSubMenu = document.querySelector('#roomSubMenu .nav-link.active');
    if (activeRoomSubMenu) {
        roomsButton.classList.add('active');
    }
});