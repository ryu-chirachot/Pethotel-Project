<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    @foreach ($Pets_rooms as $Pet_room)
        <h2>{{ $Pet_room->roomType->Rooms_type_name }}</h2>

        @php
            $imagePaths = explode(", ", $Pet_room->image->ImagesPath);
            $count = 1;
        @endphp

        <div class="grid-container">
            @foreach ($imagePaths as $path)
                <div class="image{{ $count }}">
                    <img src="{{asset('images/'.trim($path)) }}" alt="{{ $Pet_room->image->ImagesName }}">
                </div>
                @php
                    $count++;
                @endphp
            @endforeach
        </div>
        @php
            $facilities = explode(", ", $Pet_room->facility);
        @endphp
        <div class="facality">
            @foreach ($facilities as $facility)
                <div class="tag">{{ $facility }}</div>
            @endforeach
        </div>

        <p>{{ $Pet_room->Rooms_type_description }}</p>
    @endforeach

    <style>
        body {
    padding-left: 10%;
    padding-right: 10%;
    font-family: "Arial", sans-serif;
    background-color: #E7F2F4;
    }

    h2 {
        font-size: 48px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 5px;
        justify-items: center;
    }

    .image1 {
        grid-column: span 5;
    }

    .image2 {
        grid-column: span 7;
        grid-row: span 2;
    }

    .image3 {
        grid-column: span 5;
    }

    .image4, .image5, .image6 {
        grid-column: span 4;
    }

    img {
        width: 100%;
        height: 100%;
    }

    .tag {
        border: 1px solid black;
        border-radius: 8px;
        padding: 12px;
        display: inline-block;
        margin-right: 5px;
        margin-top: 20px;
    }

    </style>
</body>
</html>