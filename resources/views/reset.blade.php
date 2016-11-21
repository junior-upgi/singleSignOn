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
<body style="padding-top:40px;padding-bottom:40px;background-color:#eee;">
    <div class="container">
		@if (!$check)
			<form class="form-signin" id="checkForm" role="form" action="check" method="POST" style="max-width:330px;padding:15px;margin:auto;">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				<h2 class="form-signin-heading">單一登入帳號申請</h2>
				<label for="account" class="control-label">帳號(員工編號)</label>
				<input type="text" id="account" name="account" class="form-control" minlength="4" maxlength="20" placeholder="請輸入員工編號" required autofocus="">
				<label for="personalID" class="">身份證號</label>
				<input type="text" id="personalID" name="personalID" class="form-control" minlength="10" maxlength="10" placeholder="請輸入身份證號" required >
				@if ($result)
					<h4>錯誤訊息：{{ $msg }}</h4>
				@endif
				<button class="btn btn-lg btn-primary btn-block" style="margin-top:20px;" type="submit">驗證</button>
			</form>
		@else
			<form class="form-signin" id="setadForm" role="form" action="set" method="POST" style="max-width:330px;padding:15px;margin:auto;">
				<p>員工編號：{{ $account }}</p>
				<p>姓名：{{ $name }}</p>
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
				<input type="hidden" id="account" name="account" value="{{ $account }}">
				<input type="hidden" id="name" name="name" value="{{ $name }}">
				<input type="password" id="password" name="password" class="form-control" minlength="4" maxlength="20" placeholder="請輸入密碼" required autofocus="">
				<input type="password" id="passwordConf" name="passwordConf" class="form-control" minlength="4" maxlength="20" placeholder="確認密碼" required autofocus="">
				@if (isset($error))
					<h4>錯誤訊息：{{ $error }}</h4>
				@endif 
				<button class="btn btn-lg btn-primary btn-block" style="margin-top:20px;" type="submit">送出</button>
			</form>
		@endif
    </div>
</body>
</html>