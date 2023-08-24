<?php

use App\Models\Doctor;

function isActiveDoctor($email)
{
    $count = Doctor::where('email', $email)->where('is_active', 1) - count();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function isRole($dataArr, $moduleName, $role = 'view')
{
    if (!empty($dataArr[$moduleName])) {
        $roleArr = $dataArr[$moduleName];
        if (!empty($roleArr) && in_array($role, $roleArr)) {
            return true;
        }
    }
    return false;
}
