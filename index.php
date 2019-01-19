<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GalibWeb Scrapper</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <p>Example input: http://www.bangladeshpost.gov.bd/postcode/index/39</p>
                <div class="form-group">
                    <input type="url" class="form-control" id="scrap-url">
                </div>
                <div class="form-group">
                    <button type="submit" id="submitBtn" class="btn btn-primary btn-block">Get Data</button>
                </div>
                <div id="response" style="height: 60px;"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-success d-table mx-auto" id="copy">Copy to Clipboard</button>
                <div id="data"></div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
    
    <script>
        $("#submitBtn").on('click', function() {
            var url = $('#scrap-url').val();
            if(url !== '') {
                $.ajax({
                    url: 'scrapper.php',
                    type: 'POST',
                    data: {url:url},
                    beforeSend: function() {
                        $('#response').html('<div class="alert alert-info">Fetching Data...</div>');
                    },
                    success: function(data) {
                        $('#data').html(data);
                        $('#response').html('');
                    }
                });
            }
        });
        $('#copy').on('click', function() {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($("#data").text()).select();
            document.execCommand("copy");
            $temp.remove();
            $('#response').html('<div class="alert alert-info">Copy Successful!</div>');
            setTimeout(() => {
                $('#response').html('');
            }, 2000);
        })

        // $("#submitBtn").on('click', function() {
        //     var url = $('#scrap-url').val();
        //     if(url !== '') {
        //         $.ajax({
        //             url: 'scrapper.php',
        //             type: 'POST',
        //             data: {url:url},
        //             beforeSend: function() {
        //                 $('#response').html('<div class="alert alert-info">Fetching Data...</div>');
        //             },
        //             success: function(data) {
        //                 $('#response').html('');
        //                 // $('#data').html(data);
        //                 postToDatabase(data);
        //             }
        //         });
        //         function postToDatabase(data) {
        //             $.ajax({
        //                 url: 'http://bdpostalapi.local/api/postal',
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 contentType: "application/json; charset=utf-8",
        //                 data: JSON.stringify(data),
        //                 beforeSend: function() {
        //                     $('#response').html('<div class="alert alert-info">Posting Data...</div>');
        //                 },
        //                 success: function(res) {
        //                     $('#response').html('<div class="alert alert-info">Data Posted...</div>');
        //                     $('#data').html(res);
        //                     setTimeout(() => {
        //                         $('#response').html('');
        //                     }, 2000);
        //                 }
        //             });
        //         }
        //     }
        // });

        // $('#copy').on('click', function() {
        //     var $temp = $("<input>");
        //     $("body").append($temp);
        //     $temp.val($("#data").text()).select();
        //     document.execCommand("copy");
        //     $temp.remove();
        //     $('#response').html('<div class="alert alert-info">Copy Successful!</div>');
        //     setTimeout(() => {
        //         $('#response').html('');
        //     }, 2000);
        // })
    </script>
</body>

</html>