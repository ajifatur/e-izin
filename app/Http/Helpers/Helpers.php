<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Role;
use App\Models\Setting;

// Role
if(!function_exists('role')) {
    function role($key) {
        // Get the role by ID
        if(is_int($key)) {
            $role = Role::find($key);
            return $role ? $role->name : null;
        }
        // Get the role by key
        elseif(is_string($key)) {
            $role = Role::where('code','=',$key)->first();
            return $role ? $role->id : null;
        }
        else return null;
    }
}

// Setting
if(!function_exists('setting')) {
    function setting($key) {
        // Get the setting value by key
        $setting = Setting::where('code','=',$key)->first();
        return $setting ? $setting->value : '';
    }
}

// Time to string
if(!function_exists('time_to_string')) {
    function time_to_string($time) {
		if($time < 60)
			return $time." detik";
		elseif($time >= 60 && $time < 3600)
			return fmod($time, 60) > 0 ? floor($time / 60)." menit ".fmod($time, 60)." detik" : floor($time / 60)." menit";
		else
			return fmod($time, 60) > 0 ? floor($time / 3600)." jam ".(floor($time / 60) - (floor($time / 3600) * 60))." menit ".fmod($time, 60)." detik" : floor($time / 3600)." jam ".(floor($time / 60) - (floor($time / 3600) * 60))." menit";
    }
}

// Check attendance
if(!function_exists('attendance')) {
    function attendance($work_hour) {
        $group = Auth::user()->group_id;
        $attendances = Attendance::where('office_id','=',Auth::user()->office_id)->where('workhour_id','=',$work_hour)->where('date','=',date('Y-m-d'))->where('exit_at','=',null)->whereHas('workhour', function (Builder $query) use ($group) {
            return $query->where('group_id','=',$group);
        })->count();
        return $attendances;
    }
}

// Filter string
if(!function_exists('filter_string')) {
    function filter_string($text, $strings) {
        $result = $text;
        if(is_array($strings)) {
            foreach($strings as $string) {
                $result = str_replace($string, '', $result);
            }
        }
        elseif(is_string($strings)) {
            $result = str_replace($strings, '', $result);
        }

        return $result;
    }
}