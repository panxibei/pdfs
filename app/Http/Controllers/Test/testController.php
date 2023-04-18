<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Adldap\AdldapInterface;
use Adldap\Laravel\Facades\Adldap;

use DB;
use Image;
use Mail;
use App\Models\Admin\Config;
use App\Models\Admin\User;

use Spipu\Html2Pdf\Html2Pdf;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Codedge\Fpdf\Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;

use App\Models\Pdfs\Pdfs_actor;

class testController extends Controller
{
    // test界面
	public function test() {

		return view('test.test');
		
	}
	
	
	// phpinfo
	public function phpinfo() {

		return view('test.phpinfo');
		
	}


	// ldap
	public function ldap(AdldapInterface $ldap)
    {

		// dd($ldap->search()->users()->get());
		$data = $ldap->search()->users()->get()->toArray();
// dd($data);

		$username = 'ca071215958';
		$password = 'Aota12345678';

		try {
			$ldap = Adldap::auth()->attempt(
				// $user['name'] . env('LDAP_ACCOUNT_SUFFIX'),
				$username,
				$password
				);
				
			// 获取用户email
			$user_tmp = Adldap::search()->users()->find($username);		
			$email = $user_tmp['mail'][0];
		}
		// catch (Exception $e) {
		catch (\Adldap\Auth\BindException $e) { //捕获异常
			echo 'Message: ' .$e->getMessage();
			$ldap = false;
		}
dd($email);

		// return view('test.ldap', [
            // 'users' => $ldap->search()->users()->get()
        // ]);
		return view('test.ldap', $data);
    }
	
	
    // scroll界面
	public function scroll() {

		return view('test.scroll');
		
	}

    // mint界面
	public function mint() {

		return view('test.mint');
		
	}

    // muse界面
	public function muse() {

		return view('test.muse');
		
	}

    // vant界面
	public function vant() {

		return view('test.vant');
		
	}

    // cube界面
	public function cube() {

		return view('test.cube');
		
	}

    // mysql界面
	public function mysql()
    {

		$res['data1'] = null;
		$res['data2'] = null;
		$res['data3'] = null;

		// $res['data1'] = DB::connection('mysql')->table('users')->find(1);
		$res['data1'] = Pdfs_actor::find(1);

		return view('test.mysql', $res);
    }

    // pgsql界面
	public function pgsql()
    {

		$res['data1'] = null;
		$res['data2'] = null;
		$res['data3'] = null;

		$res['data1'] = DB::connection('mysql')->table('users')->find(1);
		$res['data2'] = DB::connection('pgsql')->table('users')->find(1);
		$res['data3'] = DB::connection('sqlsrv')->table('PerEmployee')->first();

		return view('test.pgsql', $res);
    }

    // pdf界面
	public function pdf()
    {

		$res['data1'] = [1];
		$res['data2'] = [2];
		$res['data3'] = [3];

		// $html2pdf = new Html2Pdf();
		// $html2pdf->addFont('楷体', '', '');
		// $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test<br>测试一下！aa');
		// $html2pdf->output();

		// initiate FPDI
		//$pdf = new Fpdf();
		// $pdf->AddPage();
		// $pdf->SetFont('Courier', 'B', 18);
		// $pdf->Cell(50, 25, 'Hello World!');
		// $pdf->Output();
	
		// initiate FPDI
		$pdf = new Fpdi();
		// add a page
		$pdf->AddPage();

		$url = storage_path('app/download/filez.pdf');
//dd($url);
		// set the source file
		//$pdf->setSourceFile(Storage::url('download/Percona-Distribution-PostgreSQL-11.16.pdf'));
		$pdf->setSourceFile($url);
		//dd($pdf);
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at position 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx, 10, 10, 200);

		// now write some text above the imported page
		//$pdf->AddGBFont('simhei','黑体');
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(255, 0, 0);
		$pdf->SetXY(30, 30);
		$pdf->Write(0, 'This is just a simple text你好！');
////

$pdf->Ellipse(100,50,30,20);
$pdf->SetFillColor(255,255,0);
$pdf->Circle(110,47,7,'F');

		$pdf->Output('I', 'generated.pdf');

dd($pdf);

		// $res['html2pdf'] = $html2pdf;
		//$res['html2pdf'] = $pdf->Output('I', 'generated.pdf');

		//return view('test.pdf', $res);
		return view('test.pdf');
    }	


    // 测试camera
	public function camera()
    {

		$res['data1'] = null;

		$res['data1'] = DB::connection('pgsql')->table('renshi_jiabans')
		->select('camera_imgurl')
		->where('id', 2)
		->first();

		return view('test.camera', $res);
    }	



	/**
	 * testCamera
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function testCamera(Request $request)
	{
		if (! $request->isMethod('post') || ! $request->ajax()) return null;

		$data = $request->only(
			'id',
			'imgurl'
		);

		$mydate = date('y-m-d H:i:s',time());
		$myuser = '年年庆余年';

		$img = Image::make($data['imgurl'])
			->resize(160, 120)
			->text($myuser, 20, 20, function($font) {
				$font->file(public_path() . '/fonts/msyhbd.ttc');
				$font->size(9);
				$font->color('#fdf6e3');
				$font->align('center');
				$font->valign('middle');
				$font->angle(45);
			})
			->text($mydate, 80, 110, function($font) {
				$font->file(public_path() . '/fonts/msyhbd.ttc');
				$font->size(9);
				$font->color('#fdf6e3');
				$font->align('center');
				$font->valign('middle');
				// $font->angle(45);
			})
			->encode('png')
			->encode('data-url');
		
		// dd($img);
		// dd($img->encoded);
		// dd($data);
		$data['imgurl'] = $img->encoded;

		// 写入数据库
		try	{
			$result = DB::table('renshi_jiabans')
			->where('id', $data['id'])
				->update([
					'camera_imgurl'	=> $data['imgurl'],
				]);
			$result = 1;
		}
		catch (\Exception $e) {
			echo 'Message: ' .$e->getMessage();
			$result = 0;
		}

		return $result;
	}


	/**
	 * mail
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function mail()
	{
			
		$config = Config::pluck('cfg_value', 'cfg_name')->toArray();
		// dd($config['EMAIL_ENABLED']);
		
		$email_enabled = $config['EMAIL_ENABLED'];
			// dd($email_enabled['cfg_value']);

			$useremail = User::select('email')->where('id', 1)->first();
			// dd($useremail['email']);

			$site_title = $config['SITE_TITLE'];
			
			$name = '王宝花';
			$subject = '【' . $site_title . '】 您有一条来自 [' . $name . '] 的新消息等待处理';
			// $to = 'kydd2008@163.com';
			$to = 'fenghua-gao@alpine-china.com';

			// Mail::send()的返回值为空，所以可以其他方法进行判断
			Mail::send('test.mailtemplate',['name'=>$name, 'site_title'=>$site_title],function($message) use($to, $subject){
				
				$message ->to($to)->subject($subject);
			});
			// 返回的一个错误数组，利用此可以判断是否发送成功
			if (empty(Mail::failures())) {
				dd('Sent OK!');
			} else {
				dd(Mail::failures());
			}
	}


    // echarts界面
	public function echarts() {

		return view('test.echarts');
		
	}


}
