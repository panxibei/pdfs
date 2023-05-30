@extends('home.layouts.homebase')

@section('my_title')
Login - 
@parent
@endsection

@section('my_js')
<script type="text/javascript">
</script>
@endsection

@section('my_logo_and_title')
@parent
@endsection


@section('my_body')
@parent


<p slot="title" style="text-align:center">
	{{$SITE_TITLE}}
	<small>{{$SITE_VERSION}}</small>
</p>

<v-form v-model="valid" ref="form" lazy-validation>

<v-container>

	<v-row>
        <v-col cols="12" md="12">
		<v-text-field
		v-model="username"
		label="用户"
		required
		></v-text-field>
		</v-col>
	</v-row>

	<v-text-field
	v-model="password"
	label="密码"
	type="password"
	required
	></v-text-field>


      <v-row>
        <v-col cols="12" md="8">
			<v-text-field
			v-model="captcha"
			label="验证码"
			required
			></v-text-field>
		</v-col>
		<v-col cols="6" md="4">
	<img ref="captcha" src="{{captcha_src('flatxz')}}" @click="captchaclick" style="cursor:pointer;vertical-align:top;">
		</v-col>
	  </v-row>



	<v-btn
		:disabled="!valid"
		color="success"
		class="mr-4"
		@click="handleSubmit"
		>
		提交
	</v-btn>

	<v-btn
		color="error"
		class="mr-4"
		@click="handleReset"
		>
		重置
	</v-btn>



	</v-container>
</v-form>








@endsection

@section('my_footer')
<br><br>
@parent
<br><br><br><br>
@endsection

@section('my_js_others')
<script>
var vm_app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	components: {
			
	},
	data: {
		valid: false,
		username: '',
		password: '',
		captcha: '',
		rememberme: false,

		usernameRules: [
			v => !!v || '请输入用户名',
		],
		passwordRules: [
			v => !!v || '请输入密码',
			v => v.length >= 3 || '* 密码长度至少3位以上',
		],
		captchaRules: [
			v => !!v || '请输入验证码',
			v => v.length >= 3 || '* 请输入4位长度的验证码',
		],
		



		formInline: {
			username: '',
			password: '',
			captcha: '',
			rememberme: false,
			loginmessage: ''
		},
		ruleInline: {
			username: [
				{ required: true, message: '* 请输入用户名', trigger: 'blur' }
			],
			password: [
				{ required: true, message: '* 请输入密码', trigger: 'blur' },
				{ type: 'string', min: 3, message: '* 密码长度至少3位以上', trigger: 'blur' }
			],
			captcha: [
				{ required: true, message: '* 请输入验证码', trigger: 'blur' },
				{ type: 'string', min: 4, message: '* 请输入4位长度的验证码', trigger: 'blur' }
			]
		},

		disabled_login_submit: false,
		disabled_login_reset: false,

		loading_submit: false,
		
    },
	methods: {
		handleSubmit(name) {
			this.$refs[name].validate((valid) => {
				if (valid) {
					var _this = this;

					_this.logindisabled(true);
					// _this.formInline.loginmessage = '<div class="text-info">正在验证...</div>';
					_this.$Message.loading('正在验证...');

					if (_this.formInline.username == undefined || _this.formInline.password == undefined || _this.formInline.captcha == undefined ||
						_this.formInline.username == '' || _this.formInline.password == '' || _this.formInline.captcha == '') {
						// _this.formInline.loginmessage = '<div class="text-warning">内容未填写完整！</div>';
						_this.$Message.warning('内容未填写完整！');
						_this.logindisabled(false);
						return false;
					}
					

					var url = "{{ route('login.checklogin') }}";
					axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';
					axios.post(url, {
						name: _this.formInline.username,
						password: _this.formInline.password,
						captcha: _this.formInline.captcha,
						rememberme: _this.formInline.rememberme
					})
					.then(function (response) {
						// console.log(response.data);
						// return false;
						
						if (response.data) {

							if (response.data=='nosingleuser') {
								// _this.formInline.loginmessage = '<font color="red">用户已在其他地方登录！ 请注销后重试！</font>';
								_this.$Message.warning('用户已在其他地方登录！ 请注销后重试！');
								_this.logindisabled(false);
								return false;
							}



							_this.formInline.password = '**********';
							// _this.formInline.loginmessage = '<font color="blue">登录成功！ 正在跳转...</font>';
							_this.$Message.success('登录成功！ 正在跳转...');
							window.setTimeout(function(){
								_this.loginreset;
								// var url = "{{ route('portal') }}";
								var url = "{{ route('pdfs.applicant') }}";
								window.location.href = url;
								_this.formInline.loginmessage = '';
							}, 1500);
						} else {
							// _this.formInline.loginmessage = '<font color="red">验证码错误或登录失败！</font>';
							_this.$Message.warning('验证码错误或登录失败！');
							_this.logindisabled(false);
						}
					})
					.catch(function (error) {
						// console.log(error);
						// _this.formInline.loginmessage = '<font color="red">用户过期或未知错误！</font>';
						_this.$Message.error('用户过期或未知错误！');
						_this.logindisabled(false);
					})
					_this.captchaclick();
				} else {
					// this.$Message.error('Fail!');
				}
			})
		},
		handleReset (name) {
			this.$refs[name].resetFields();
		},
		captchaclick: function(){
			this.$refs.captcha.src+=Math.random().toString().substr(-1);
		},
		logindisabled: function (value) {
			var _this = this;
			if (value) {
				_this.$refs.ref_username.disabled = true;
				_this.$refs.ref_password.disabled = true;
				_this.$refs.ref_captcha.disabled = true;
				_this.$refs.ref_rememberme.disabled = true;
				_this.disabled_login_submit = true;
				_this.disabled_login_reset = true;
				_this.loading_submit = true;
			} else {
				_this.$refs.ref_username.disabled = false;
				_this.$refs.ref_password.disabled = false;
				_this.$refs.ref_captcha.disabled = false;
				_this.$refs.ref_rememberme.disabled = false;
				_this.disabled_login_submit = false;
				_this.disabled_login_reset = false;
				_this.loading_submit = false;
			}
		},
	}
});
</script>
@endsection