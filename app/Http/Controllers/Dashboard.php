<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function showAllMediaType(){
        $media = Media::orderBy('id', 'desc')->get();
        return Inertia('dashboard/AllMediaType', ['media' => $media]);
    }

    public function showUsers(Request $request){
        $users = User::query()
            ->when($request->search, function($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
                ->orderBy("id", "desc")
                ->paginate(5)
                ->withQueryString()
                ->through(fn($user)=>[
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_image' => $user->profile_image,
                    'created_at' => $user->created_at,
                ]);

        return Inertia::render('dashboard/Users', [
            'users' => $users,
            'filters' => $request->only(['search']),
        ]);
    }

    public function editUser(User $user){
        return Inertia::render('dashboard/EditUser', ['user' => $user]);
    }

    public function updateUser(Request $request, User $user){
        // dd($request);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'min:6'],
            'profile_image' => ['nullable', 'image', 'max:2048']
        ]);

        // update name, email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password only if provided
        if(!empty($validated['password'])){
            $user->password = bcrypt($validated['password']);
        }

        //update profile image
        if($request->hasFile('profile_image')){
            $path = $request->file('profile_image')->store('profile_image', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('dashboard.showUsers')->with('success', 'User updated successfully');
    }

    public function destroyUser(User $user){
        $user->delete();
        return redirect()->route('dashboard.showUsers')->with('success', 'user deleted Successfully');
    }
}
