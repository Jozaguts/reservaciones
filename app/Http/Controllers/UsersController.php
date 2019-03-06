<?php

namespace App\Http\Controllers;


use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
Use Illuminate\Http\Request as R;
Use Request;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('web')){
            $users = User::all();
            $roles = Role::all()->pluck('name','id');
    
            return view('sections.administration',compact('users','roles'));
        }else{
            return redirect()->back();
        }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(R $request)
    {

         $rules =[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role'=> ['required', 'string'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'department'=> ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:6', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{6,}$/']
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'active' => 'required|string',
            // 'removed' => 'nullable|boolean',
            // 'role' => 'boolean',
            // 'department' => 'required|string',
            // 'email' => 'required|string|email|max:255|unique:usuarios',
            // 'password' => 'required|string|min:8confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{6,}$/'
        ];
        // $data = Request::all();

        $validator = Validator::make($request->all(), $rules);
        // dd($role = $request->role);
        if ($validator->fails()) {
            return redirect('usuarios')
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = $request->role;
        switch ($role) {
            case 'administrador':
                $user = User::create($request->all());
                $user->assignRole('administrador');
                    return redirect()->back();
                        break;        
            case 'supervisor':
                $user = User::create($request->all());
                $user->assignRole('supervisor');
                    return redirect()->back();
                        break;   
            case 'operador':
                $user = User::create($request->all());
                $user->assignRole('operador');
                    return redirect()->back();
                        break;
        }        
      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json($user);
      
    }
     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
      if($request->ajax())
      {
          $user = User::findOrfail($id);
          $input = $request->all();
          if($result = $user->fill($input)->save()){
            //asignamos rol
            $user->assignRole($request->role);
        }

          if($result)
          {
              return response()->json(['success'=>'true']);
          }else
          {
              return response()->json(['success'=>'false']);
          }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $requeste)
    {
         
         User::find($id)->delete();
         $message = "Usuario Eliminado exitosamente";
         if($request->ajax()){
             return $message;
         }
       
       
    }
}
