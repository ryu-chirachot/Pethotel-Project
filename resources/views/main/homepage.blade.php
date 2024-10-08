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
        .reviews-container {
    overflow: hidden;
    position: relative;
    width: 100%;
    height: 220px;
}

.reviews-content {
    display: block;
    white-space: nowrap;
    animation: scroll 10s linear infinite;
}

.review-box {
    display: inline-block;
    width: 200px;
    margin: 10px;
    padding: 15px;
    background-color: #ffe894;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    white-space: normal;
    vertical-align: top;
}

@keyframes scroll {
    0% {
        transform: translateX(-100%);
    }
    70% {
        transform: translateX(100%);
    }
}

.reviews-content:hover {
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

    
    <div class="container mt-5">
        @if($reviews->count() == 0)
            
        @else
        <h2 class="text-center " style="margin-top: -60px;">รีวิวจากลูกค้า</h2>
        <div class="reviews-container">
            
            <div class="reviews-content">
                @foreach($reviews as $review)
                    <div class="review-box">
                        @foreach($detail as $d)
                            
                        @endforeach
                    <div class="d-flex justify-content-between">
                    <label class="text-dark">{{ substr($review->booking->user->name, 0, 2)}} *****</label>
                <label class="text-muted">{{ $review->updated_at->format('d/m/Y') }}</label>
            </div>
          
                    <div class="star-rating">
                        <label>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            </label>
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

@endsection