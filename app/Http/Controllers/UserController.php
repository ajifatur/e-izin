<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ajifatur\Helpers\Date;
use Ajifatur\Helpers\Salary;
use App\Models\User;
use App\Models\Role;
use App\Models\Group;
use App\Models\Office;
use App\Models\SalaryCategory;
use App\Models\UserIndicator;
use App\Models\Attendance;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->query('office') == null) {
                // Get users by the group
                $users = User::where('group_id','=',$request->query('group'))->where('role','=',role('member'))->where('end_date','=',null)->orderBy('name','asc')->get();
            }
            else {
                // Get users by the group and office
                $users = User::where('group_id','=',$request->query('group'))->where('office_id','=',$request->query('office'))->where('role','=',role('member'))->where('end_date','=',null)->orderBy('name','asc')->get();
            }

            // Return
            return response()->json($users);
        }

        // Get users
        if(Auth::user()->role == role('super-admin')) {
            if($request->query('role') == 'admin')
                $users = User::where('role','=',role('admin'))->get();
            elseif($request->query('role') == 'manager')
                $users = User::where('role','=',role('manager'))->get();
            elseif($request->query('role') == 'member')
                $users = $request->query('group') != null && $request->query('office') != null && $request->query('position') != null ? User::where('role','=',role('member'))->where('group_id','=',$request->query('group'))->where('office_id','=',$request->query('office'))->where('position_id','=',$request->query('position'))->where('end_date','=',null)->get() : User::where('role','=',role('member'))->where('end_date','=',null)->get();
            else
                return redirect()->route('admin.user.index', ['role' => 'member']);
        }
        elseif(Auth::user()->role == role('admin')) {
            if($request->query('role') == 'admin')
                $users = User::where('role','=',role('admin'))->where('group_id','=',Auth::user()->group_id)->get();
            elseif($request->query('role') == 'manager')
                $users = User::where('role','=',role('manager'))->where('group_id','=',Auth::user()->group_id)->get();
            elseif($request->query('role') == 'member')
                $users = $request->query('office') != null && $request->query('position') != null ? User::where('role','=',role('member'))->where('group_id','=',Auth::user()->group_id)->where('office_id','=',$request->query('office'))->where('position_id','=',$request->query('position'))->where('end_date','=',null)->get() : User::where('role','=',role('member'))->where('group_id','=',Auth::user()->group_id)->where('end_date','=',null)->get();
            else
                return redirect()->route('admin.user.index', ['role' => 'member']);
        }
        elseif(Auth::user()->role == role('manager')) {
            if($request->query('role') == 'admin' || $request->query('role') == 'manager')
                abort(403);
            elseif($request->query('role') == 'member')
                $users = $request->query('office') != null && $request->query('position') != null ? User::where('role','=',role('member'))->where('group_id','=',Auth::user()->group_id)->where('office_id','=',$request->query('office'))->where('position_id','=',$request->query('position'))->where('end_date','=',null)->get() : User::where('role','=',role('member'))->where('group_id','=',Auth::user()->group_id)->where('end_date','=',null)->get();
            else
                return redirect()->route('admin.user.index', ['role' => 'member']);
        }

        // Get groups
        $groups = Group::all();

        // Set categories
        $categories = [];

        // Set the users prop
        if(count($users) > 0 && $request->query('role') == 'member') {
            // Set default date
            $dt1 = date('m') > 1 ? date('Y-m-d', strtotime(date('Y').'-'.(date('m')-1).'-24')) : date('Y-m-d', strtotime((date('Y')-1).'-12-24'));
            $dt2 = date('Y-m-d', strtotime(date('Y').'-'.date('m').'-23'));
			
            foreach($users as $key=>$user) {
                // Set categories
                $categories = SalaryCategory::where('group_id','=',$user->group_id)->where('position_id','=',$user->position_id)->get();
                $users[$key]->categories = $categories;

                // Set the period by month
                $users[$key]->period = abs(Date::diff($user->start_date, date('Y-m').'-24')['days']) / 30;
				
                // Set the attendance by month
                $users[$key]->attendances = Attendance::where('user_id','=',$user->id)->where('date','>=',$dt1)->where('date','<=',$dt2)->count();

                // Set salaries
                $salaries = [];
                foreach($categories as $category) {
                    // By manual
                    if($category->type_id == 1) {
                        $check = $user->indicators()->where('category_id','=',$category->id)->first();
                        $value = $check ? $check->value : 0;
                        array_push($salaries, Salary::getAmountByRange($value, $user->group_id, $category->id));
                    }
                    // By period per month
                    elseif($category->type_id == 2)
                        array_push($salaries, Salary::getAmountByRange($users[$key]->period, $user->group_id, $category->id));
                    // By attendance per month
                    elseif($category->type_id == 3)
                        array_push($salaries, Salary::getAmountByRange($users[$key]->attendances, $user->group_id, $category->id) * $users[$key]->attendances);
                }

                $users[$key]->salaries = $salaries;
            }
        }

        // View
        return view('admin/user/index', [
            'users' => $users,
            'groups' => $groups,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get roles
        $roles = Role::where('code','!=','super-admin')->orderBy('num_order','asc')->get();

        // Get groups
        $groups = Group::all();

        // View
        return view('admin/user/create', [
            'roles' => $roles,
            'groups' => $groups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'role' => Auth::user()->role == role('manager') ? '' : 'required',
            'group_id' => Auth::user()->role == role('super-admin') ? 'required' : '',
            'office_id' => !in_array($request->role, [role('admin'), role('manager')]) ? 'required' : '',
            'position_id' => !in_array($request->role, [role('admin'), role('manager')]) ? 'required' : '',
            'name' => 'required|max:200',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'username' => 'required|alpha_dash|min:4|unique:users',
            'password' => 'required|min:6',
            // 'status' => 'required'
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Save the user
            $user = new User;
            $user->role = Auth::user()->role == role('manager') ? role('member') : $request->role;
            $user->group_id = Auth::user()->role == role('super-admin') ? $request->group_id : Auth::user()->group_id;
            $user->office_id = !in_array($request->role, [role('admin'), role('manager')]) ? $request->office_id : 0;
            $user->position_id = !in_array($request->role, [role('admin'), role('manager')]) ? $request->position_id : 0;
            $user->name = $request->name;
            $user->birthdate = Date::change($request->birthdate);
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->start_date = Date::change($request->start_date);
            $user->end_date = $request->end_date != '' ? Date::change($request->end_date) : null;
            $user->phone_number = $request->phone_number;
            $user->latest_education = $request->latest_education;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            // $user->status = $request->status;
            $user->last_visit = null;
            $user->save();

            // Get the role
            $role = Role::find($user->role);

            // Redirect
            return redirect()->route('admin.user.index', ['role' => $role->code])->with(['message' => 'Berhasil menambah data.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        // Get the user
        $user = User::findOrFail($id);

        // View
        return view('admin/user/detail', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the user
        $user = User::findOrFail($id);

        // Get roles
        $roles = Role::where('code','!=','super-admin')->orderBy('num_order','asc')->get();

        // Get groups
        $groups = Group::all();

        // View
        return view('admin/user/edit', [
            'user' => $user,
            'roles' => $roles,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'role' => Auth::user()->role == role('manager') ? '' : 'required',
            'office_id' => !in_array($request->role, [role('admin'), role('manager')]) ? 'required' : '',
            'position_id' => !in_array($request->role, [role('admin'), role('manager')]) ? 'required' : '',
            'name' => 'required|max:200',
            'birthdate' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            'email' => [
                'required', 'email', Rule::unique('users')->ignore($request->id, 'id')
            ],
            'username' => [
                'required', 'alpha_dash', 'min:4', Rule::unique('users')->ignore($request->id, 'id')
            ],
            'password' => $request->password != '' ? 'min:6' : '',
            // 'status' => 'required'
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Update the user
            $user = User::find($request->id);
            $user->role = Auth::user()->role == role('manager') ? role('member') : $request->role;
            $user->office_id = $request->office_id;
            $user->position_id = $request->position_id;
            $user->name = $request->name;
            $user->birthdate = Date::change($request->birthdate);
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->start_date = Date::change($request->start_date);
            $user->end_date = $request->end_date != '' ? Date::change($request->end_date) : null;
            $user->phone_number = $request->phone_number;
            $user->latest_education = $request->latest_education;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = $request->password != '' ? bcrypt($request->password) : $user->password;
            // $user->status = $request->status;
            $user->save();

            // Get the role
            $role = Role::find($user->role);

            // Redirect
            return redirect()->route('admin.user.index', ['role' => $role->code])->with(['message' => 'Berhasil mengupdate data.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editIndicator($id)
    {
        // Get the user
        $user = User::findOrFail($id);

        // Get categories
        $categories = SalaryCategory::where('group_id','=',$user->group_id)->where('position_id','=',$user->position_id)->where('type_id','=',1)->get();

        // View
        return view('admin/user/edit-indicator', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateIndicator(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'value.*' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()){
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else{
            // Get
            $user = User::find($request->id);
            $role = Role::find($user->role);
            $values = $request->value;

            // Update or add the indicator
            if(count($values) > 0) {
                foreach($values as $key=>$value) {
                    $user_indicator = UserIndicator::where('user_id','=',$user->id)->where('category_id','=',$key)->first();
                    if(!$user_indicator) $user_indicator = new UserIndicator;

                    $user_indicator->user_id = $request->id;
                    $user_indicator->category_id = $key;
                    $user_indicator->value = $value;
                    $user_indicator->save();
                }
            }

            // Redirect
            if(Auth::user()->role == role('super-admin'))
                return redirect()->route('admin.user.index', ['role' => $role->code, 'group' => $user->group_id, 'office' => $user->office_id, 'position' => $user->position_id])->with(['message' => 'Berhasil mengupdate data.']);
            elseif(Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))
                return redirect()->route('admin.user.index', ['role' => $role->code, 'office' => $user->office_id, 'position' => $user->position_id])->with(['message' => 'Berhasil mengupdate data.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {        
        // Get the user
        $user = User::find($request->id);

        // Delete the user
        $user->delete();

        // Redirect
        return redirect()->route('admin.user.index')->with(['message' => 'Berhasil menghapus data.']);
    }
}
