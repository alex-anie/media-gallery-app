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
                ->through(fn($name)=>[
                    'id' => $name->id,
                    'names' => $name-> name,
                ]);

        return Inertia::render('dashboard/Users', [
            'names' => $users,
            'filters' => $request->only(['search']),
        ]);
    }
}
