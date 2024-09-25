document.addEventListener("DOMContentLoaded", ()=> {
    const roomsButton = document.getElementById("roomsButton");
    const roomSubMenu = document.getElementById("roomSubMenu");
    const updown = document.getElementById("drop");

    // ซ่อน โชว์ Dropdown เพิ่ม,แก้ไข
    roomsButton.addEventListener("click", ()=> {
        if (updown.className.includes("fa-caret-down")) {
            updown.className = updown.className.replace("fa-caret-down", "fa-caret-up");
            roomSubMenu.style.display = roomSubMenu.style.display === "none" ? "block" : "none";
        } else {
            updown.className = updown.className.replace("fa-caret-up", "fa-caret-down");
            roomSubMenu.style.display = roomSubMenu.style.display === "none" ? "block" : "none";
        }
    });


    // เงื่อนไขถ้ามีการกดที่เพิ่ม,แก้ไขของห้องพัก ให้ห้องพักเปลี่ยน css ด้วย
    const activeRoomSubMenu = document.querySelector('#roomSubMenu .nav-link.active');
    if (activeRoomSubMenu) {
        roomsButton.classList.add('active');
    }
});