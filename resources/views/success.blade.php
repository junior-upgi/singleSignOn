<html lang="zh">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>開發案管理系統</title>
	<script>
		var url = "{{url('/')}}";
	</script>
	<link rel="stylesheet" href="{{ url('/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">
</head>
<body>
    <div class="container text-center">
        <div style="margin-top:180px;">
            <h1 class="">帳號申請/修改成功</h2>
            <a href="{{ env('PORTAL', 'http://upgi.ddns.net') }}">點擊此連結回首頁</a>
        </div>
    </div>
</body>
</html>