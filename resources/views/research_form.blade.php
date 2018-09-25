<!DOCTYPE html>
<html>
    <head>
        <title>Tweets</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
    </head>
    <body>
        <div class="container">
            <div class="col-md-12">
                <h1> Buscar #hashtags no Twitter:</h1>
                <hr>
                <br>
                <form class="form-inline">
                    <input type="text" class="form-control mb-3 mr-sm-3" id="searchInput" placeholder="digite a #hashtag" required>
                    <button type="submit" class="btn btn-primary mb-3" id="searchBtn">Pesquisar</button>
                </form>               
            </div>
            <h1 id="resultsTitle"></h1>
            <br>
            <div class="col-md-12">
                <ol class="" id="outPutCommentsList">
                    <!-- <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li> -->
                </ol>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    
    $('#searchBtn').click(function(e) {
        e.preventDefault();
        var searchInput = $('#searchInput').val();

        $.ajaxSetup({

            headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

        });
        $.ajax({
            url: '/results',
            type: 'POST',
            data: { 'search': searchInput},
            ContentType: 'application/json',
            success: function (data) {
                $('#resultsTitle').text('Resultados para: ' + data.success.HashTag);
                $('#outPutCommentsList').empty();
                for (var i = 0; i < data.success.messages.length; i++) {
                    $('#outPutCommentsList').append('<li class="" font-weight">' + data.success.messages[i] + '</li>');
                    //console.log();
                }
                //alert(data.success.HashTag);
            },
            error: function (e,i) {
                console.log(e,i);
                //alert("error");
            }
        });
    });
</script>