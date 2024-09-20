<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายละเอียดสัตว์เลี้ยง</title>
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
        
        <form action="/o" method="post">
        @csrf
        <h2 class="text-2xl font-bold mb-4">ข้อมูลสัตว์เลี้ยง</h2>
            
            <div>
            <div class="mb-4">
                <input type="text" name="name" class="w-full p-2 border rounded" placeholder="ชื่อของสัตว์เลี้ยง">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <select class="w-full p-2 border rounded" placeholder="ประเภทสัตว์เลี้ยงประเภทสัตว์เลี้ยง">
                        <option value="test">ประเภทสัตว์เลี้ยง</option>

                    </select>
                </div>
                <div>
                    <input name="breed" type="text" class="w-full p-2 border rounded" placeholder="สายพันธุ์">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <input name="age" type="number" class="w-full p-2 border rounded" placeholder="อายุ">
                </div>
                <div>
                    
                    <input type="number" name="weight"class="w-full p-2 border rounded" placeholder="น้ำหนัก (kg)">
                </div>
            </div>
            <div class="mb-4">
                <select name="gender">
                <option  value="Male">ชาย</option>
                <option  value="Female">หญิง</option>
               </select>
            </div>
            <div class="mb-4">
                <select name="vac">
                <label class="block mb-2">ประวัติการฉีดวัคซีน</label>
                <!-- foreach($vac as $vaccine) -->
                <input type="checkbox" name="vaccine" value="{$vaccine}">ประวัติการฉีดวัคซีน
                <!-- endforeach -->
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2">คำแนะนำ / ข้อกำหนดเพิ่มเติม :</label>
                <textarea name="comment" class="w-full p-2 border rounded" rows="3" placeholder="เช่น โรคประจำตัว , สิ่งที่ต้องทำประจำ"></textarea>
            </div>
            <button type="submit" class="w-full bg-yellow-400 text-black p-2 rounded">ถัดไป</button>
            </div>
        </form>
    </div>
</body>

</html>