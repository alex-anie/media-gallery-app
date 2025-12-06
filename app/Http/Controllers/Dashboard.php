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
}
