<?php
namespace App\Repositories;

use App\Models\Staff;
use App\Models\User;

class StaffRepository
{
    public $staff;
    public $user;

    public function __construct(Staff $staff, User $user)
    {
        $this->staff = $staff;
        $this->user = $user;
    }

    public function checkPersonal($id, $personalID)
    {
        $check = $this->staff->where('ID', $id)->where('PersonalID', $personalID);
        return $check;
    }
    
    public function userExists($id)
    {
        $exists = $this->user->where('mobileSystemAccount', $id)->exists();
        return $exists;
    }

    public function insertUser($params)
    {
        try {
            $this->user->insert($params);
            return [
                'success' => true,
                'msg' => 'success',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'msg' => $e['errorInfo'][2]
            ];
        }
        
    }
}