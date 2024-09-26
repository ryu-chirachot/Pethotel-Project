@extends('layouts.searchbar')
@section('review')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Display</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .reviews-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            width: 100%;
            height: 200px; /* ความสูงของรีวิวแต่ละบล็อก */
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
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* หยุดเมื่อวางเมาส์ */
        .reviews-container:hover .reviews-content {
            animation-play-state: paused;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">รีวิวจากลูกค้า</h2>
    <div class="reviews-container">
        <div class="reviews-content">
            <!-- เริ่มลูปรีวิวที่นี่ -->
            @foreach($reviews as $review)
                <div class="review-box">
                    <h5>Anonymous</h5>
                    <p>{{ $review->comment }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection