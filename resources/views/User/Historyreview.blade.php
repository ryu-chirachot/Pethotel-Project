@extends('layouts.navbar')
@section('content')
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

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">ประวัติการรีวิวห้องพักของคุณ</h3>
        </div>
        @foreach($review as $rw)
            <div class="form-group">
                    <h4 for="rating" class="text-center mt-4">ระดับความพึงพอใจ</h4>
                    <div class="rating">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating_{{ $rw->Review_id }}" id="star{{ $i }}_{{ $rw->Review_id }}" value="{{ $i }}" {{ $rw->rating == $i ? 'checked' : '' }} disabled>
                            <label for="star{{ $i }}_{{ $rw->Review_id }}"></label>
                        @endfor
                    </div>
                </div>
            <div class="form-group">
                <h4 for="comment" class="mt-4">ความคิดเห็น</h4>
                <textarea name="comment" id="comment" class="form-control" rows="4" readonly>{{$rw->comment}}</textarea>
            </div>
        @endforeach
    </div>
</div>
@endsection