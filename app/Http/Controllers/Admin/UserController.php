<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roleRelation');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roleRelation', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $users = $query->paginate(10)->appends($request->all());
        $roles = Role::all();

        return view('admin.pages.users', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'nullable|exists:roles,id',
            'status' => 'required|in:active,inactive',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        
        $user->avatar = 'https://ui-avatars.com/api/?name=' . urlencode($request->name) . '&background=random&color=fff';

        $user->save();

        return redirect()->back()->with('success', 'Thêm người dùng thành công!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'role_id' => 'nullable|exists:roles,id',
            'status' => 'required|in:active,inactive',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Đã xóa người dùng thành công!');
    }
}
