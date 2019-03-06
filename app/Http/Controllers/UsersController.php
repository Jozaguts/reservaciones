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
    public function index(R $request)
    {   
          //acesso si es administrador
            if($role = Auth::user()->hasRole('administrador')){
                $users = User::all();
                $roles = Role::all()->pluck('name','id');
                return view('sections.administration',compact('users','roles'));
            }else{
                return redirect('/home')->with('info','No Tienes Aceeso de Administrador');
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
        //reglas de validacion
         $rules =[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role'=> ['required', 'string'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'department'=> ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:6', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{6,}$/']
           
        ];
      
        //Se realiza la validación
        $validator = Validator::make($request->all(), $rules);
        
        //si falla se redirige con los errores a la vista
        if ($validator->fails()) {
            return redirect('usuarios')
                        ->withErrors($validator)
                        ->withInput();
        }
        // se recupera el role
        $role = $request->role;
        //evalua el rol
        switch ($role) {
            case 'administrador':
                $user = User::create($request->all()); //se crea el usuario
                $user->assignRole('administrador'); //se asigna el rol
                    return redirect()->back(); //redireccion hacia atras 
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
    public function edit(R $request, $id)
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
    public function update(R $request, $id)
    {   
        //reglas de validacion
        $rules =[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role'=> ['required', 'string'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'department'=> ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => [ 'string', 'min:6','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{6,}$/']
           
        ];
     
      

      if($request->ajax())
      {
          $user = User::findOrfail($id);

          //verificar si la contraseña esta vacia
            if($request['password']!= null){
                $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }
            //Se realiza la validación
        $validator = Validator::make($request->all(), $rules);

        
       
        
        //si falla se redirige con los errores a la vista
        if ($validator->fails()) {
            return redirect('usuarios')
                        ->withErrors($validator)
                        ->withInput();
        }
          $input = $request->all();

          if($result = $user->fill($input)->save()){
            
            //se retira el role actual y se asigna otro
            $user->syncRoles($request->role);
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
