@extends('layouts.navbar')
@section('title','สัตว์เลี้ยงของฉัน')
@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">สัตว์เลี้ยงของฉัน</h2>

    @if($pets->isEmpty())
        <p class="text-center text-danger">ไม่มีประวัติสัตว์เลี้ยงของคุณ</p>
    @else
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ประเภทสัตว์เลี้ยง</th>
                    <th>ชื่อสัตว์เลี้ยง</th>
                    <th>เพศ</th>
                    <th>สายพันธุ์</th>
                    <th>อายุ</th>
                    <th>น้ำหนัก</th>
                    <th>คำแนะนำ</th>
                </tr>
            </thead>
            <tbody>

                @foreach($pets as $pet)
                <tr>
                    <td>
                        {{$pet->petType->Pet_nametype}}
                    </td>
                    <td>{{ $pet->Pet_name }}</td>
                    <td>{{ $pet->Pet_gender == 'M' ? 'ชาย' : 'หญิง' }}</td>
                    <td>{{ $pet->Pet_breed }}</td>
                    <td>{{ $pet->Pet_age }} ปี</td>
                    <td>{{ $pet->Pet_weight }} kg</td>
                    <td>{{ $pet->comment ?? 'ไม่มี' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection