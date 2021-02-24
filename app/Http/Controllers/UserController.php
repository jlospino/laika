<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocumentType;
use App\Http\Requests\ManageUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *Return view list users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Get a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = User::select(['id', 'name', 'email', 'address', 'document', 'document_type_id'])
                        ->with('documentType:id,code,description')
                        ->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new users.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document_types = DocumentType::all();
        return view('users.create', compact('document_types'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Requests\ManageUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required|unique:user',
                'document' => 'required|numeric|unique:user',
                'document_type_id' => 'required|numeric',
            ];
            $messages = [
                'name.required' => 'Debe asignar un nombre al usuario',
                'address.required' => 'Debe asignar una dirección al usuario',
                'email.required' => 'Debe asignar un correo electrónico al usuario',
                'email.unique' => 'El correo electrónico ingresado ya se encuentra registrado',
                'document.required' => 'Debe asignar un número de documento al usuario',
                'document.unique' => 'El número de documento ya se encuentra registrado',
                'document.numeric' => 'El número de documento ingresado no es valido',
                'document_type_id.required' => 'Debe seleccionar un tipo de documento'
            ];
            $validation = Validator::make($request->all(), $rules, $messages);

            if($validation->fails()){
                return Response()->json($validation->errors()->all());
            }

            $user = new User();
            $user->name = $request->name;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->document = $request->document;
            $user->document_type_id = $request->document_type_id;
            $user->save();
            return Response()->json(['status'=>true,'data'=>'Usuario '.$user->name.' creado correctamente.']);
        }catch (\Throwable $e) {
            return response()->json($e->getMessage(),'500');
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $document_types = DocumentType::all();
        return view('users.edit', compact('user','document_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified users in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required',
                'document' => 'required|numeric',
                'document_type_id' => 'required|numeric',
            ];
            $messages = [
                'name.required' => 'Debe asignar un nombre al usuario',
                'address.required' => 'Debe asignar una dirección al usuario',
                'email.required' => 'Debe asignar un correo electrónico al usuario',
                'document.required' => 'Debe asignar un número de documento al usuario',
                'document.numeric' => 'El número de documento ingresado no es valido',
                'document_type_id.required' => 'Debe seleccionar un tipo de documento'
            ];
            $validation = Validator::make($request->all(), $rules, $messages);

            if($validation->fails()){
                return Response()->json($validation->errors()->all());
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->document = $request->document;
            $user->document_type_id = $request->document_type_id;
            $user->save();
            return Response()->json(['status'=>true,'data'=>'Usuario '.$user->name.' editado correctamente.']);
        }catch (\Throwable $e) {
            return response()->json($e->getMessage(),'500');
        }

    }

    /**
     * Remove the specified users from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Response()->json(['status'=>true,'data'=>'Usuario '.$user->name.' eliminado correctamente.']);
    }
}
