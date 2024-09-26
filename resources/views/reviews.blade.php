<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Room</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating > input {
            display: none;
        }

        .rating > label {
            cursor: pointer;
            width: 30px;
        }

        .rating > label:before {
            content: "\f005"; /* ไอคอนดาว (fa-star) */
            font-family: "Font Awesome 5 Free"; /* FontAwesome แบบฟรี */
            font-weight: 900; /* ทำให้เป็นแบบ solid */
            position: relative;
            display: block;
            font-size: 30px;
            color: #ccc;
        }

        .rating > input:checked ~ label:before {
            color: #FFD43B;
        }

        .rating > label:hover ~ label:before,
        .rating > label:hover:before {
            color: #ffe68c;
        
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">รีวิวห้องพัก</h3>
            <form id="reviewForm" method="POST" action="{{ route('submit.review') }}">
                @csrf
                <div class="form-group">
                    <label for="rating">ระดับความพึงพอใจ</label>
                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5"><label for="star5"></label>
                        <input type="radio" name="rating" id="star4" value="4"><label for="star4"></label>
                        <input type="radio" name="rating" id="star3" value="3"><label for="star3"></label>
                        <input type="radio" name="rating" id="star2" value="2"><label for="star2"></label>
                        <input type="radio" name="rating" id="star1" value="1"><label for="star1"></label>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">ความคิดเห็น</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">ยืนยัน</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('reviewForm').addEventListener('submit', function(event) {
        event.preventDefault(); // ป้องกันไม่ให้รีเฟรชหน้า

        // ส่งฟอร์มด้วย AJAX (ถ้าต้องการ) หรือส่งข้อมูลไปที่ Laravel
        Swal.fire({
            title: 'สำเร็จ!',
            text: 'ขอบคุณสำหรับความคิดเห็นของคุณ',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // ส่งฟอร์มหลังจากแสดง SweetAlert สำเร็จ
            }
        });
    });
</script>

</body>
</html>
