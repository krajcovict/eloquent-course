<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Database\Query\Builder;

use App\Models\Project;
class UserController extends Controller
{
    public function index()
    {
        echo "Hello";

        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Admin', 'password' => 'password']
        );

        dump($user->wasRecentlyCreated ? 'Created' : 'Found');
        dump($user->isDirty() ? 'Edited' : 'Unedited');
        $user->name = 'Donald';
        $user->save();
        dump($user->wasChanged() ? 'Changed' : 'Unchanged');
    }

    public function someUsers()
    {
        $users = User::whereNotNull('email_verified_at')
            ->where(function (Builder $query) {
                $query->whereDay('created_at', 4)
                    ->orWhereDay('created_at', 5);
            })
            ->get();

        dump($users);
    }

    public function latestProject()
    {
        $users = User::addSelect(['lastProject' => Project::select('created_at')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1),
        ])->get();

        // return...
    }

}
