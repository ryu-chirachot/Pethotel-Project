@extends('layouts.searchbar')
@section('content')
<!-- ส่วนที่จะทำ -->
<ul class="navbar-nav">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">เข้าสู่ระบบ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">ลงทะเบียน</a>
        </li>
    @endguest

    @auth
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">
                    ออกจากระบบ
                </button>
            </form>
        </li>
    @endauth
</ul>

@endsection