<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>
@section('my_title')
{{$SITE_TITLE}}  Ver: {{$SITE_VERSION}}
@show
</title>
<link rel="stylesheet" href="{{ asset('statics/vuetify/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('statics/vuetify/css/vuetify.min.css') }}">

<style type="text/css">

.screen_middle{
	position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f5f7f9;
    left: 0px;
    top: 0px;
    right: 0px;
    bottom: 0px;
}
</style>
@yield('my_style')
<script src="{{ asset('js/functions.js') }}"></script>
<script>
	checkBrowser();
</script>
<script>
isMobile = mobile();
if (isMobile) {
	alert('系统暂不支持移动端！');
	document.execCommand("Stop");
    window.stop();
    
    // window.setTimeout(function(){
    //    var url = "{route('logincube')}";
    //    window.location.href = url;
    // }, 1000);
}
</script>
@yield('my_js')
</head>
<body>
<div id="app">
	<v-app>

	<div class="screen_middle">
		<Layout>
			<Header class="layout-header-center">
				<!-- 头部 -->
				<br><br><br><br><br>
				@section('my_logo_and_title')
				<!-- <h1>{{$SITE_TITLE}}<br>
				<small>{{$SITE_VERSION}}</small></h1> -->
				@show
				<!-- /头部 -->
			</Header>
			<Layout>
			<Content>
				<!-- 主体 -->
				@section('my_body')
				@show
				<!-- /主体 -->
			</Content>
			</Layout>
			<Footer>
				<!-- 底部 -->
				<Footer class="layout-footer-center">
				@section('my_footer')
				<a href="{{route('portal')}}">{{$SITE_TITLE}}</a>&nbsp;&nbsp;{{$SITE_COPYRIGHT}}
				@show
				</Footer>
				<!-- /底部 -->
			</Footer>
		</Layout>
	</div>
	
	</v-app>
</div>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/bluebird.min.js') }}"></script>
<script src="{{ asset('statics/vuetify/js/vue.min.js') }}"></script>
<script src="{{ asset('statics/vuetify/js/vuetify.min.js') }}"></script>
@yield('my_js_others')
</body>
</html>