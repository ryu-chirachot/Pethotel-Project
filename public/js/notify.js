$(function() {
    var baseurl = 'http://127.0.0.1:8000/'
    $.ajax({ 
        url: baseurl + 'notify.php',
        method: 'post',
        dataType: 'json',
        data: { data: 1 }
    }).done(function(response) {
        console.log(response)
    })
})
