<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Stay Hotel - Booking Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body class="bg-[#e6f2f2] p-4">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">ข้อมูลสัตว์เลี้ยง</h2>
        <form>
            <div class="mb-4">
                <input type="text" class="w-full p-2 border rounded" placeholder="ชื่อของสัตว์เลี้ยง">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <select class="w-full p-2 border rounded" placeholder="ประเภทสัตว์เลี้ยงประเภทสัตว์เลี้ยง">
                        <option>ประเภทสัตว์เลี้ยง</option>
                        <option>ประเภทสัตว์เลี้ยง</option>
                        <option>ประเภทสัตว์เลี้ยง</option>
                        <option>ประเภทสัตว์เลี้ยง</option>

                    </select>
                </div>
                <div>
                    <input type="text" class="w-full p-2 border rounded" placeholder="สายพันธุ์">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <input type="number" class="w-full p-2 border rounded" placeholder="อายุ">
                </div>
                <div>
                    
                    <input type="number" class="w-full p-2 border rounded" placeholder="น้ำหนัก (kg)">
                </div>
            </div>
            <div class="mb-4">
                <select name="" id="">
                <option name="" value="">ชาย</option>
                <option name="" value="">หญิง</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2">ประวัติการฉีดวัคซีน</label>
                <input type="checkbox" id="">test1
                <input type="checkbox" id="">test1
                <input type="checkbox" id="">test1
                <input type="checkbox" id="">test1


            </div>
            <div class="mb-4">
                <label class="block mb-2">คำแนะนำ / ข้อกำหนดเพิ่มเติม :</label>
                <textarea class="w-full p-2 border rounded" rows="3" placeholder="เช่น โรคประจำตัว , สิ่งที่ต้องทำประจำ"></textarea>
            </div>
            <button type="submit" class="w-full bg-yellow-400 text-black p-2 rounded">ถัดไป</button>
        </form>
    </div>
</body>
</html>