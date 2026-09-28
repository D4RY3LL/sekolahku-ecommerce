<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
                     ->latest()
                     ->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat melihat detail admin');
        }
        
        $orders = $user->orders()->latest()->limit(10)->get();
        
        return view('admin.users.show', compact('user', 'orders'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus user admin');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}