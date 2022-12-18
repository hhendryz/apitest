<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Response;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $models = new User;
        $users = $models::all();
        return view('user', get_defined_vars());
    }

    public function store(UserRequest $request)
    {
        $models = new User;
        //if($request->all()){
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            //dd($request->all());
            DB::beginTransaction();
            try {
                $newuser = $models::create($data);
                DB::commit();
                return redirect(route('user'))->with('success', 'Create Success');;
            }catch (\Exception $e) {
                DB::rollback();
                //dd($e);
                return back()->withInput()->with('error', $e->getMessage());
            }
        //}
        //$users = $models::all();
        //return view('user', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        $models = new User;
        $users = $models::all();
        $curruser = $models::find($id);
        return view('user', get_defined_vars());
    }

    public function update(UserRequest $request)
    {
        $models = new User;
        DB::beginTransaction();
        try {
            $id= $request->id;
            $curruser = $models::find($id);
            $curruser->name = $request->name;
            $curruser->email = $request->email;
            if($request->password){
                 $curruser->password = Hash::make($request->password);
            }
            $curruser->save();
            DB::commit();
            return redirect(route('user'))->with('success', 'Update Success');
        }catch (\Exception $e) {
            DB::rollback();
            //dd($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
        //return view('user', get_defined_vars());
    }

    public function delete(Request $request)
    {
        $models = new User;
    
        DB::beginTransaction();
        try {
            $id= $request->id;
            $curruser = $models::find($id);
            $curruser->delete();
            DB::commit();
            return redirect(route('user'))->with('success', 'Delete Success');;
        }catch (\Exception $e) {
            DB::rollback();
            //dd($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
        //return view('user', get_defined_vars());
    }

    public function getUser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if (!$user)
            return Response::json(['error' => true]);
        $data = $user->toArray();
        return Response::json([
            'data' => $data,
            'error' => false,
            'message' => 'Get User Success!'
        ]);
    }
}
