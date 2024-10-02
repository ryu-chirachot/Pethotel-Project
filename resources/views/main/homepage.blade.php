@extends('layouts.searchbar')
@section('content')

@if (session('success'))
    <script>
        Swal.fire({
  title: "จองห้องสำเร็จ",
  text: "{{ session('success') }}",
  icon: "success"
});
    </script>
@endif

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .reviews-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            width: 100%;
            height: 220px;
            
        }
        .reviews-content {
            display: inline-block;
            animation: scroll 20s linear infinite;
        }
        .review-box {
            display: inline-block;
            width: 300px;
            margin: 10px;
            padding: 15px;
            background-color: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            white-space: normal;
            vertical-align: top;
        }
        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        .reviews-container:hover .reviews-content {
            animation-play-state: paused;
        }
        .star-rating {
            color: #e0e0e0;
            font-size: 1.2em;
        }
        .star-rating .fas {
            color: #ffc107;
        }
        .review-box p {
            max-height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        @if($reviews->count() == 0)
            
        @else
        <h2 class="text-center " style="margin-top: -60px;">รีวิวจากลูกค้า</h2>
        <div class="reviews-container">
            
            <div class="reviews-content">
                @foreach($reviews as $review)
                    <div class="review-box">
                        <h5>ผู้ใช้</h5>
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p>{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = () => {
            document.getElementById("searchForm").reset();

            const content = document.querySelector('.reviews-content');
            const totalWidth = content.offsetWidth;
            
            content.style.animation = scroll ${totalWidth / 50}s linear infinite;
        };
    </script>
@endif
</body>



</html>
@endsection