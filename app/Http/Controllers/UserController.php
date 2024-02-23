<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::latest()->paginate(5);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'usertype' => ['required', 'numeric', Rule::in([0, 1])],
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); 
        $user->usertype = $validatedData['usertype'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = User::where('name', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%")
                        ->orWhere(function ($var) use ($query) {
                            $var->where('usertype', 0)
                                ->where('usertype', 'like', "%$query%");
                        })
                        ->orWhere(function ($var) use ($query) {
                            $var->where('usertype', 1)
                                ->where('usertype', 'like', "%$query%");
                        });

        $users = $users->paginate(10);
                        
        return view('users.index', compact('users'));
    }

}
