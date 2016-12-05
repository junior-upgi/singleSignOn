<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Repositories\AuthorityRepository;

class AuthorityController extends Controller
{
    //
    public $auth;

    public function __construct(AuthorityRepository $auth)
    {
        $this->auth = $auth;
    }

    public function sidelist()
    {
        $sideList = $this->auth->getList('side')->get();
        return view('side.list')
            ->with('sideList', $sideList);
    }

    public function sideAuth()
    {
        $sideList = $this->auth->getList('side')->get();
        return view('side.auth')
            ->with('sideList', $sideList);
    }

    public function saveAuth($table)
    {
        $request = request();
        $input = $request->input();
        switch ($table) {
            case 'side':
                $result = $this->auth->saveSideAuth($input);
                break;
            case 'role':
                $result = $this->auth->saveRoleAuth($input);
                break;
            default:
                return ['success' => false, 'msg' => 'fail!!'];
        }
        
        return $result;
    }

    public function roleList()
    {
        $roleList = $this->auth->getList('role')->with('side')->orderBy('sideID')->get();
        $sideList = $this->auth->getList('side')->get();
        return view('role.list')
            ->with('roleList', $roleList)
            ->with('sideList', $sideList);
    }

    public function roleAuth()
    {
        $roleList = $this->auth->getList('role')->with('side')->orderBy('sideID')->get();
        $sideList = $this->auth->getList('side')->get();
        return view('role.auth')
            ->with('roleList', $roleList)
            ->with('sideList', $sideList);
    }

    public function getData($table, $id)
    {
        $data = $this->auth->getData($table, $id);
        return $data;
    }

    public function saveData($table)
    {
        $request = request();
        $input = $request->input();
        $result = $this->auth->saveData($table, $input);
        return $result;
    }

    public function getUser()
    {
        $user = $this->auth->getList('user');
        $member = $user->with('staff')->get()->toArray();
        $list = [];
        for ($i = 0; $i < count($member); $i++) {
            $staff = $member[$i]['staff'];
            if (isset($staff)) {
                $staff = array_except($staff, 'ID');
                $base = $member[$i];
                $base = array_except($base, 'staff');
                $newMember = array_merge($base, $staff);
                array_push($list, $newMember);
            }
        }
        $side = $this->auth->getList('sideAuth')->select(['userID', 'sideID'])->get()->toArray();
        $role = $this->auth->getList('roleAuth')->select(['userID', 'roleID'])->get()->toArray();
        $json = [];
        $json['message'] = '';
        $json['value'] = $list;
        $json['side'] = $side;
        $json['role'] = $role;
        return $json;
    }
}
