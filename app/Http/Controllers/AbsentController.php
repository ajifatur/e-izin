<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\Date;
use App\Models\Absent;
use App\Models\User;

class AbsentController extends Controller
{
    public $array = [
        1 => 'Sakit',
        2 => 'Izin'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!in_array($id, array_keys($this->array)))
            abort(404);

        // View
        return view('member/absent', [
            'id' => $id,
            'name' => $this->array[$id],
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
            'note' => 'required',
        ]);
        
        // Check errors
        if($validator->fails()) {
            // Back to form page with validation error messages
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else {
            // Get the date
            $date = date('Y-m-d');

            // Get the absent
            $absent = Absent::where('user_id','=',Auth::user()->id)->where('date','=',$date)->first();

            if($absent) {
                return redirect()->back()->with(['message' => 'Anda sudah melakukan izin untuk hari ini.']);
            }
            else {
                // Get the attachment
                $attachment = $request->file('attachment');

                // Move the attachment
                $filename = '';
                if($attachment != null) {
                    $filename = date('Y-m-d-H-i-s').' -- '.Auth::user()->id.'.'.$attachment->getClientOriginalExtension();
                    $attachment->move(public_path('assets/images/absent'), $filename);
                }

                // Save the absent
                $absent = new Absent;
                $absent->user_id = Auth::user()->id;
                $absent->category_id = $request->id;
                $absent->date = $date;
                $absent->note = $request->note;
                $absent->attachment = $filename;
                $absent->save();
            }

            // Redirect
            return redirect()->route('member.dashboard')->with(['message' => 'Berhasil melakukan izin.']);
        }
    }
}
