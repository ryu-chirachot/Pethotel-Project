@extends('layouts.searchbar')
@section('review')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        .review-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .review-box h5 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #343a40;
        }
        .star-rating {
            color: #e0e0e0;
            font-size: 1.2em;
        }
        .star-rating .fas {
            color: #ffc107;
        }
        .review-comment {
            margin-top: 10px;
            color: #495057;
        }
    </style>
</head>

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
            <p class="review-comment">{{ $review->comment }}</p>
        </div>
    @endforeach


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection