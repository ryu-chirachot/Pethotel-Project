@extends('layouts.searchbar')
@section('content')
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
    <script>
        
          document.addEventListener("DOMContentLoaded",()=>{

              Swal.fire({
              position: "center",
              icon: "success",
              title: "แก้ไขเสร้จสิ้น",
              showConfirmButton: false,
              timer: 1500
          });
})
</script>
@endif


@endsection