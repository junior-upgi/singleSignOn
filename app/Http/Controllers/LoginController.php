<?php
/**
 * 單一登入
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 16/11/09
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Redirect;
use App\Http\Controllers\Common;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller 
{
    /** @var Common 注入Common共用元件 */
    private $common;

    /**
     * 建構子
     *
     * @param Common $common
     * @return void
     */
    public function __construct(
        Common $common
    ) {
        $this->common = $common;
    }

    /**
     * 顯示登入頁面
     * 根據不同的權限導向對應的頁面
     *
     * @return view 回傳頁面
     */
    public function show()
    {
        $request = request();
        $data = $request->input();
        $url='';
        if (isset($data['url'])) {
            $url = urldecode($data['url']);
        }

        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->ID;
            return redirect()->to($url.'?user_id='.$user_id);
        } else {
            return view('login')
                ->with('url', $url);
        }
    }

    /**
     * 驗證並登入
     * 
     * @param Request $request request物件
     * @return view 回傳頁面
     */
    public function login()
    {
        $request = request();
        $input = $request->input();
        //驗證規則
        $rules = array(
            'account'=>'required',
            'password'=>'required'
        );
        $url = request()->input('url');
        isset($input['remember']) ? $remember = true : $remember = false;
        //驗證表單
        $validator = Validator::make($input, $rules);
        $type = env('WebSSO', 'LDAP');
        if ($validator->passes()) {
            $attempt = $this->common->singleSignOn($input['account'], $input['password'], $type);

            if ($attempt) {
                if (Auth::check()) {
                    $user = Auth::user();
                    $user_id = $user->ID;
                    return redirect()->to($url.'?user_id='.$user_id);
                } else {
                    return redirect('/?url=' . $url)
                        ->withErrors(['fail'=>'登入失敗!']);
                }
            }
            return redirect('/?url=' . $url)
                ->withErrors(['fail'=>'帳號或密碼錯誤!']);
        }
        return redirect('/?url=' . $url)
            ->withErrors($validator);
            //->withInput(\Input::except('password'));
    }

    /**
     * 登出
     * @return view 回傳登入頁
     */
    public function logout()
    {
        Auth::logout();
        $portal = env('PORTAL', 'http://upgi.ddns.net');
        return redirect()->to($portal);
    }
}