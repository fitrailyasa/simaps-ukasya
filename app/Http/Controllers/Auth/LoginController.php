<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        
        switch(auth()->user()->roles_id){
            case 1:
                $this->redirectTo = '/admin/dashboard';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/op/dashboard';
                return $this->redirectTo;
                break;
            case 3:
                if(auth()->user()->Gelanggang->jenis == 'Tanding'){
                    $this->redirectTo = route('dewan.tanding');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Tunggal'){
                    $this->redirectTo = route('dewan.tunggal');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Ganda'){
                    $this->redirectTo = route('dewan.ganda');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Regu'){
                    $this->redirectTo = route('dewan.regu');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Solo Kreatif'){
                    $this->redirectTo = route('dewan.solo');
                    return $this->redirectTo;
                }
                break;
            case 4:
                if(auth()->user()->Gelanggang->jenis == 'Tanding'){
                    $this->redirectTo = route('juri.tanding');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Tunggal'){
                    $this->redirectTo = route('juri.tunggal');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Ganda'){
                    $this->redirectTo = route('juri.ganda');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Regu'){
                    $this->redirectTo = route('juri.regu');
                    return $this->redirectTo;
                }else if(auth()->user()->Gelanggang->jenis == 'Solo Kreatif'){
                    $this->redirectTo = route('juri.solo');
                    return $this->redirectTo;
                }
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
        
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
