<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display the registration view.
     */
    
     public function index()
     {
         //
         $user = Auth::user();
         $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') 
            ->where('model_has_roles.role_id', '1') 
            ->select('users.*') 
            ->orderBy('users.id', 'DESC')
            ->get();
         return view('admin.user.index', [
             'users'=> $users,
             'user'=> $user,
         ]);
     }

    public function create(): View
    {
        $user = Auth::user();
        return view('admin.user.create', [
            'user' => $user,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('HR');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard.user.index');
    }
    
    public function show(User $user)
    {
        //
        $people = $user->people()->orderBy('id', 'DESC')->get();

        return view('admin.user.manage', [
            'user'=> $user,
            'people'=> $people,
        ]);
    }

    public function edit(User $user)
    {
        //
        $user = Auth::user();
        return view('admin.user.edit', [
            'user'=> $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            DB::commit();
            return redirect()->route('dashboard.user.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        //
        try{
            $user->delete();
            return redirect()->route('dashboard.user.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
