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
            <h3 class="text-center">รีวิวห้องพัก</h3>
        </div>
            <div class="form-group">
                    <h4> for="rating">ระดับความพึงพอใจ</h4>
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
    </div>
</div>
@endsection