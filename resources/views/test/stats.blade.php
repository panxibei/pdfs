<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
	<title>test stats</title>
	<!-- <link rel="stylesheet" href="{{ asset('css/mpdf.css') }}"> -->
</head>
<body>

stats:<br>
@foreach($data as $value)
    {{ $value }} <br>
@endforeach

</body>
</html>