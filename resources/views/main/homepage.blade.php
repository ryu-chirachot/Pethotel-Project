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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: 'Arial, sans-serif';
        background-color: #f5f5f5;
    }

    .reviews-container {
        overflow: hidden;
        position: relative;
        width: 100%;
        height: 250px;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    }

    .reviews-content {
        display: flex;
        white-space: nowrap;
        animation: scroll 20s linear infinite;
    }

    .review-box {
        display: inline-block;
        width: 220px;
        margin-right: 15px;
        padding: 15px;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
        position: relative;
    }

    .review-box:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
    }

    @keyframes scroll {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .star-rating {
        color: #e0e0e0;
        font-size: 1.2em;
    }

    .star-rating .fas {
        color: #ffcc00;
    }

    .review-user, .review-date, .review-type, .review-room {
        font-size: 0.85em;
        color: #888;
    }

    .review-comment {
        margin-top: 10px;
        font-size: 0.9em;
        color: #444;
    }

    h2 {
        color: #333;
        font-weight: 600;
    }
</style>


    @if($reviews->count() > 0)
        <h2 class="text-center mb-10">รีวิวจากลูกค้า</h2>
        
            <div class="reviews-content mb-5">
                @foreach($reviews as $review)
                    <div class="review-box">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="review-user">{{ substr($review->booking->user->name, 0, 2) }}*****</span>
                            <span class="review-date">{{ $review->updated_at->format('d/m/Y') }}</span>
                        </div>
                        <span class="review-type">{{ $review->booking->pet->pettype->Pet_nametype }}</span> • 
                        <span class="review-room">{{ $review->booking->room->roomtype->Rooms_type_name }}</span>
                        
                        <div class="star-rating mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="review-comment">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        
    @endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = () => {
        document.getElementById("searchForm").reset();

        const content = document.querySelector('.reviews-content');
        const totalWidth = content.scrollWidth;

        content.style.animation = `scroll ${totalWidth / 120}s linear infinite`;

        // Add event listeners to pause animation only when hovering over .review-box
        const reviewBoxes = document.querySelectorAll('.review-box');
        reviewBoxes.forEach(box => {
            box.addEventListener('mouseenter', () => {
                content.style.animationPlayState = 'paused';
            });
            box.addEventListener('mouseleave', () => {
                content.style.animationPlayState = 'running';
            });
        });
    };
</script>

@endsection