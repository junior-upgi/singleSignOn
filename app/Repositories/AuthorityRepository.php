<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Http\Controllers\Common;
use App\Models\Staff;
use App\Models\User;
use App\Models\Side;
use App\Models\SideAuthority;
use App\Models\Role;
use App\Models\RoleAuthority;

class AuthorityRepository extends BaseRepository
{
    public $staff;
    public $user;
    public $side;
    public $sideAuth;
    public $role;
    public $roleAuth;

    public function __construct(
        Common $common,
        Staff $staff,
        User $user,
        Side $side,
        SideAuthority $sideAuth,
        Role $role,
        RoleAuthority $roleAuth
    ) {
        parent::__construct();
        $this->staff = $staff;
        $this->user = $user;
        $this->side = $side;
        $this->sideAuth = $sideAuth;
        $this->role = $role;
        $this->roleAuth = $roleAuth;
    }

    //->whereIn('id', $id_list)->get();

    public function getList($table)
    {
        $list = $this->getCollection($table);
        return $list;
    }

    public function getData($table, $id)
    {
        $where = [];
        $set = ['key' => 'id', 'value' => $id];
        array_push($where, $set);
        $data = $this->getCollection($table, $where)->first();
        return $data;
    }

    public function saveData($table, $input, $igone = [], $pk = 'ID')
    {
        $result = $this->save($table, $input, $igone, $pk);
        return $result;
    }

    public function saveSideAuth($input)
    {
        try {
            $userID = $input['userID'];
            if (isset($input['sides'])) {
                $sides = $input['sides'];
            } else {    
                $sides = [];
            }
            $table = $this->getTable('sideAuth');
            foreach ($sides as $side) {
                $params = ['userID' => $userID, 'sideID' => $side, 'type' => ''];
                $table->updateOrCreate($params);
            }
            $del = $table->where('userID', $userID)->whereNotIn('sideID', $sides)->delete();
            return ['success' => true,'msg' => 'success!'];
        } catch (\Exception $e) {
            return ['success' => false,'msg' => $e['errorInfo'][2]];
        }
    }

    public function saveRoleAuth($input)
    {
        try {
            $userID = $input['userID'];
            if (isset($input['roles'])) {
                $roles = $input['roles'];
            } else {    
                $roles = [];
            }
            $table = $this->getTable('roleAuth');
            foreach ($roles as $role) {
                $params = ['userID' => $userID, 'roleID' => $role, 'type' => ''];
                $table->updateOrCreate($params);
            }
            $del = $table->where('userID', $userID)->whereNotIn('roleID', $roles)->delete();
            return ['success' => true,'msg' => 'success!'];
        } catch (\Exception $e) {
            return ['success' => false,'msg' => $e['errorInfo'][2]];
        }
    }

    protected function getTable($table)
    {
        switch ($table) {
            case 'side':
                return $this->side;
                break;
            case 'sideAuth':
                return $this->sideAuth;
                break;
            case 'role':
                return $this->role;
                break;
            case 'roleAuth':
                return $this->roleAuth;
            case 'staff':
                return $this->staff;
                break;
            case 'user':
                return $this->user;
                break;
            default:
                throw new Exception('No model exception');
        }
    }
}