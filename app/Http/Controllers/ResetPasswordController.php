<?php
/**
 * 使用者申請與重設密碼
 *
 * @version 1.0.0
 * @author spark it@upgi.com.tw
 * @date 16/10/14
 * @since 1.0.0 spark: 於此版本開始編寫註解
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;

use App\Http\Controllers\Common;

use App\Repositories\StaffRepository;

/**
 * Class ResetpasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController
{
    /** @var Common 注入共用元件 */
    private $common;
    /** @var StaffRepository 注入StaffRepository */
    private $staff;

    /**
     * 建構式
     *
     * @param Common $common
     * @param StaffRepository $staff
     * @return void
     */
    public function __construct(Common $common, StaffRepository $staff)
    {
        $this->common = $common;
        $this->staff = $staff;
    }
    
    /**
     * 回傳重設密碼頁面
     *
     * @return view 重設密碼頁面
     */
    public function resetPassword()
    {
        return view('reset')
            ->with('check', false)
            ->with('result', false);
    }

    /**
     * 驗證個人基本資料
     * 
     * @param Request $request request內容
     * @return view 回傳頁面
     */
    public function checkPersonal(Request $request)
    {
        $input = $request->input();
        $ID = $input['account'];
        $personalID = studly_case($input['personalID']);
        $check = $this->staff->checkPersonal($ID, $personalID);
        if ($check->exists()) {
            $staff = $check->first();
            return view('reset')
                ->with('check', true)
                ->with('result', true)
                ->with('account', $staff->ID)
                ->with('name', $staff->name);
        } else {
            return view('reset')
                ->with('check', false)
                ->with('result', true)
                ->with('msg', '驗證失敗');
        }
    }

    /**
     * 對Model進行insert的方法
     * 
     * @param Request $request request內容
     * @return view 回傳頁面
     */
    public function setPassword(Request $request)
    {
        $input = $request->input();
        $ID = $input['account'];
        $name = $input['name'];
        $password = $input['password'];
        $passwordConf = $input['passwordConf'];
        if ($password !== $passwordConf) {
            return view('reset')
                ->with('check', true)
                ->with('result', true)
                ->with('account', $ID)
                ->with('name', $name)
                ->with('error', '密碼與確認密碼不一致');
        }

        $exist = $this->staff->userExists($ID);
        if (!$exist) {
            //新增資料
            $params = array(
                'mobileSystemAccount' => $ID,
                'erpID' => $ID
            );
            $db = $this->staff->insertUser($params);
            if (!$db['success'])  {
                return view('reset')
                    ->with('check', true)
                    ->with('result', true)
                    ->with('account', $ID)
                    ->with('name', $name)
                    ->with('error', $db['msg']);
            }
        }

        $existLDAP = $this->common->searchLDAP($ID);
        if ($existLDAP) {
            $ldap = $this->common->modifyLDAP($ID, $password);
        } else {
            $ldap = $this->common->addLDAP($ID, $password);
        }
        if ($ldap) {
            return view('success');
        }
        return view('reset')
            ->with('check', true)
            ->with('result', true)
            ->with('account', $ID)
            ->with('name', $name)
            ->with('error', '單一登入申請失敗');
    }
}