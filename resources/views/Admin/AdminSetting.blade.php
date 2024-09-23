@extends('layouts.AdminSidebar')

@section('content')
<div class="display-inline text-center my-4">
        <h3><b>การตั้งค่า</b></h3>
    </div>
    <input id='myInput' onkeyup='searchTable()' type='text'>

<table id='myTable' border="1px">
    <tr border="1px">
        <td border="1px">Apple</td>
        <td border="1px">Green</td>
    </tr>
    <tr border="1px">
        <td border="1px">Grapes</td>
        <td border="1px">Green</td>
    </tr>
    <tr border="1px">
        <td border="1px">Orange</td>
        <td border="1px">Orange</td>
    </tr>
</table>

<script>
function searchTable(){
    var term, table;
    // get term to search
    term = document.getElementById("myInput").value.toLowerCase();
    
    // get table rows, handle as array.
    table = Array.from(document.getElementById("myTable").rows);
    
    // filter non-matching rows; these are set to display='none'
    table.filter(function(el){return el.textContent.toLowerCase().indexOf(term) == 
    -1}).map(x=> x.style.display = "none");
    
    // filter matching rows; these are set to display =''
    table.filter(function(el){return el.textContent.toLowerCase().indexOf(term) > -1}).map(x=> x.style.display = "");
}
</script>

@endsection