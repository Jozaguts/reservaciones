<?php
namespace App\Http\Controllers;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
Use Illuminate\Http\Request;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
    public function store(Request $request)
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
              return response()->json(['success'=>'false','error'=>$validator->errors()->all()]);  
              
            
          }
      if($request->ajax()){
          
            // se recupera el role
            $role = $request->role;
            //evalua el rol
            switch ($role) {
                case 'administrador':
                    $user = User::create($request->all()); //se crea el usuario
                    $user->assignRole('administrador'); //se asigna el rol
                        return response()->json(['success'=>'true', 200, 'ok' => 'Usuario Agregado Correctamente', 200]);
                            break;        
                case 'supervisor':
                    $user = User::create($request->all());
                    $user->assignRole('supervisor');
                        return response()->json(['success'=>'true', 200, 'ok' => 'Usuario Agregado Correctamente', 200]);
                        redirect()->back();
                            break;   
                case 'operador':
                    $user = User::create($request->all());
                    $user->assignRole('operador');
                    return response()->json(['success'=>'true', 200, 'ok' => 'Usuario Agregado Correctamente', 200]);
                        // redirect()->back();
                            break;
            }        

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
           //verificar si la contraseña esta vacia
           if($request['password']!= null){
            $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }
      if($request->ajax())
      {
          $user = User::findOrfail($id);
       
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
          if($result) {
            return response()->json(['success'=>'true', 200, 'correcto' => 'Usuario Editado Correctamente', 200]);
        }
        else
         {
            return response()->json(['success'=>'false','error'=>'Error no se Puedo Editar al Usuario ']);  
        }
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);  
         $user->delete();
         $message = "Usuario Eliminado exitosamente";
         $error ="No se pudo Eliminar";
         if($user == null)
            {
                return response()->json(['success'=>'false', 'error'=> $error]);
            }else
            {
                return response()->json(['success'=>'true', 'message'=> $message]);
            }
       
       
    }
}