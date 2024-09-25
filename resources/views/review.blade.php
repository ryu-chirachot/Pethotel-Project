
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="r"><h1>REVIEW</h1></div>
    <div class="grid-container">
        @foreach ($reviews as $review)
            <div class="grid-content">
            @php
                $createdAt = \Carbon\Carbon::parse($review->created_at);
                $now = \Carbon\Carbon::now();
                $diffInHours = $now->diffInHours($createdAt);
                $diffInDays = $now->diffInDays($createdAt);
            @endphp

            <p class="time">
                @if ($diffInHours > 0)
                    {{ floor($diffInHours) }} ชั่วโมงก่อน
                @elseif ($diffInDays > 0)
                    {{ floor($diffInDays) }} วันก่อน
                @else
                    เพิ่งนี้
                @endif
            </p>
                <div class="img-rate">
                    <svg width="64" height="64" viewBox="0 0 20 20" fill="none" xmlns="['options' => \Carbon\Carbon::DIFF_RELATIVE_TO_NOW]">
                        <path d="M10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20ZM15 11.5C15 10.6716 14.3284 10 13.5 10H6.5C5.67157 10 5 10.6716 5 11.5V12C5 13.9714 6.85951 16 10 16C13.1405 16 15 13.9714 15 12V11.5ZM12.75 6.25C12.75 4.73122 11.5188 3.5 10 3.5C8.4812 3.5 7.25 4.73122 7.25 6.25C7.25 7.76878 8.4812 9 10 9C11.5188 9 12.75 7.76878 12.75 6.25Z" fill="#D9D9D9"/>
                    </svg>
                    <p>
                        @if ($review->rating == 0)
                            <img src="images\ratingStar\0.png">
                        @elseif ($review->rating == 1)
                            <img src="images\ratingstar\0haft.png">
                        @elseif ($review->rating == 2)
                            <img src="images\ratingStar\1.png">
                        @elseif ($review->rating == 3)
                            <img src="images\ratingstar\1haft.png">
                        @elseif ($review->rating == 4)
                            <img src="images\ratingstar\2.png">
                        @elseif ($review->rating == 5)
                            <img src="images\ratingstar\2haft.png">
                        @elseif ($review->rating == 6)
                            <img src="images\ratingstar\3.png">
                        @elseif ($review->rating == 7)
                            <img src="images\ratingstar\3haft.png">
                        @elseif ($review->rating == 8)
                            <img src="images\ratingstar\4.png">
                        @elseif ($review->rating == 9)
                            <img src="images\ratingstar\4haft.png">
                        @elseif ($review->rating == 10)
                            <img src="images\ratingStar\5.png">
                       
                        @endif
                    </p>


                </div>
                @if($review->booking)
                    <p>ชื่อ: {{ $review->booking->user->Name }}</p>
                @endif
                <p>{{ $review->content }}</p>
            </div>
        @endforeach
    </div>
  

    <style>
        .r {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .time {
            font-size: small;
            color: gray;
        }
        body {
            background-color: #E7F2F4;
            padding-left: 10%;
            padding-right: 10%;
            font-family: "Arial", sans-serif;
        }
        .img-rate {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1rem;
            justify-items: center;
        }
        .grid-content{
            grid-column: span 3;
            background-color: white;
            padding: 0rem 1rem;
            width: 85%;
        }
    </style>

</body>
</html>