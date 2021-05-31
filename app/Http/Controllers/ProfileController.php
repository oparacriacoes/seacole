<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:190'],
            'email' => ['required', 'string', 'unique:users,email,'.$user->id],
            'fone_celular_1' => ['sometimes', 'string', 'max:190'],
            'fone_celular_2' => ['sometimes', 'string', 'max:190']
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email']
        ])->save();

        if (!$user->is_admin) {
            $professional = $user->professional;
            $professional->fill([
                'fone_celular_1' => $validated['fone_celular_1'],
                'fone_celular_2' => $validated['fone_celular_2'],
            ])->save();
        }

        return back()
            ->with('status-profile', 'success')
            ->with('message', 'Perfil atualizado!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'password' => 'required|string|confirmed|min:8',
            'password_current' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Senha incorreta, informe a senha correta para a alteração');
                }
            }]
        ]);

        $user->fill([
            'password' => Hash::make($validated['password'])
        ])->save();

        return back()
            ->with('status-password', 'success')
            ->with('message', 'Senha alterada');
    }
}
