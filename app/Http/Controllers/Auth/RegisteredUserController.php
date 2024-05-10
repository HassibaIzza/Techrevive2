<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegisteredNewVendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:100', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                Password::min(8) // Longueur minimale de 8 caractères
                    ->mixedCase() // Doit contenir des majuscules et des minuscules
                    ->numbers() // Doit contenir des chiffres
                    ->symbols() // Doit contenir des symboles
                    ->uncompromised(), // Vérifie si le mot de passe a été exposé dans des fuites de données (nécessite une connexion internet)
            ],
            'role' => 'required|string|in:vendor,client,reparateur,Fabricant',
        ]);



        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->input('role'),

        ]);

        if ($request->role == 'vendor'){
            self::completeVendorRegistration($user);
        }
        
        
        

        event(new Registered($user));

        Auth::login($user);

        // notify the admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new RegisteredNewVendor());
        return redirect(self::redirectTo());
        
    }

    
 
    public static function completeVendorRegistration($user){
        DB::table('vendor_shop')->insert([
            'shop_description' => null,
            'shop_name' => null,
            'user_id' => $user->id
        ]);
    }

    protected function redirectTo()
{
    $role=Auth::user()->role;
    switch ($role) {
        case 'admin':
            $url = '/admin/profile';
            break;
        case 'vendor':
            $url = '/vendor/profile';
            break; // Ajout du break ici
        case 'reparateur':
            $url = 'reparateur/profile';
            break; // Ajout du break ici
        case 'client' :
            $url = 'client/profile';
            break; 
        case 'Fabricant':
            $url= 'Fabricant/profile';
            break; 
        default:
            $url = '/profile';
            break; // Ajout du break ici
    }
    return $url;
}
}
