<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends Controller

{
    public function index(){

        $searchQuery=request('query');

        $users=User::query()
                    ->when(request('query'),function($query,$searchQuery){
                    $query->where('name','like',"%{$searchQuery}%");

                    })
                    ->latest()
                    ->paginate(5);


                    return $users;

        

    
  

}



public function store(){

  request()->validate([
    'email'=>'required|unique:users,email',
   ]);

    $user=User::create([
        'name'=>request('name'),
        'email'=>request('email'),
        'password'=>bcrypt(request('password'))

    ]);

    return $user;
}
public function update(User $user)
{
    request()->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,' . $user->id,
        'password' => 'sometimes|min:8',
    ]);

    $user->update([
        'name' => request('name'),
        'email' => request('email'),
        'password' => request('password') ? bcrypt(request('password')) : $user->password,
    ]);

    return $user;
}


public function destroy(User $user){
    $user->delete();
    return response()->noContent();

}

public function changeRole(User $user){
    $user->update([
        'role'=>request('role'),
    ]);

    return response()->json(['success'=>true]);

}

// public function search()
// {
//     $searchQuery = request('query');

//     $users = User::where('name', 'like', "%{$searchQuery}%")->paginate(1);

//     return response()->json($users);
// }




public function bulkDelete(){
      User::whereIn('id',request('ids'))->delete();
      return response()->json(['message'=>'User deleted successfully']);
}




}



