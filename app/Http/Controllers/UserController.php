<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\TableBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        $tables = Table::take(3)->get();
        return view('user.dashboard', compact('tables'));
    }

    public function profile() {
        $user = auth()->user();

        // Pass the $user variable to the 'user.profile.profile' view
        return view('user.profile.profile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'bio' => 'nullable|string',
            'current_password' => 'required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->password && !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->fill($request->only([
            'name',
            'email',
            'phone_number',
            'address',
            'birth_date',
            'bio'
        ]));

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $directory = 'photos/profiles';
            $filename = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        
            $path = $request->file('photo')->storeAs($directory, $filename, 'public');
        
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function tables()
    {
        $tables = Table::orderBy('capacity', 'desc')->get();
        foreach ($tables as $table) {
            $table->image_url = Storage::url($table->image);
        }
        return view('user.tables.index', ['tables' => $tables]);
    }

    public function bookTablesView(Request $request, $table_id)
    {
        $table = Table::findOrFail($table_id);
        $table->image_url = Storage::url($table->image);

        return view('user.tables.booking', ['table' => $table]);
    }


    public function bookTables(Request $request, $table_id)
    {
        // $request->validate([
        //     'duration' => 'required|integer',
        // ]);
        dd($request);
        $table = Table::findOrFail($table_id);
        TableBooking::create([
            'user_id' => Auth::id(),
            'table_id' => $table_id,
            'booking_time' => $request->input('datetime'),
            // 'duration' => 3,
            'duration' => $request->input('open-duration'),
            'status' => 'active',
        ]);
        return redirect()->route('user.tables')->with(['booking_status' => 'Berhasil booking table ' . $table->number . '!']);
    }

    public function loyaltyProgramIndex()
    {
        //
        $user = auth()->user();
        return view('user.loyalty.index', compact('user'));
    }
}
