<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kritik Dan Saran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Terikirim</h2>
   @if(Session::has('status'))
                <div class="alert alert-success">{{ Session::get('status') }}</div>
                @endif
</div>
<div class="modal-footer">
          <button type="button" class="btn btn-default"><a href="{{url('/')}}"style="text-decoration:none">Kembali</a></button>
        </div>
</body>
</html>
