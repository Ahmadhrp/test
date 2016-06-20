<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laravel 5.2</title>
	{!! Html::style('private/aset/css/bootstrap.min.css') !!}
</head>
<body>
	@yield('content')

	{!! HTML::script('private/aset/js/jquery.min.js') !!}
	{!! HTML::script('private/aset/js/bootstrap.min.js') !!}
</body>
</html>