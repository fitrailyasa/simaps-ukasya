<?php
// Ukasya
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkUser()
    {
        switch (auth()->user()->roles_id) {
            case 1:
                $this->redirectTo = '/admin/dashboard';
                return redirect($this->redirectTo);
                break;
            case 2:
                $this->redirectTo = '/op/dashboard';
                return redirect($this->redirectTo);
                break;
            case 3:
                if (auth()->user()->Gelanggang->jenis == 'Tanding') {
                    $this->redirectTo = route('dewan.tanding');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Tunggal') {
                    $this->redirectTo = route('dewan.tunggal');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Ganda') {
                    $this->redirectTo = route('dewan.ganda');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Regu') {
                    $this->redirectTo = route('dewan.regu');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Solo Kreatif') {
                    $this->redirectTo = route('dewan.solo');
                    return redirect($this->redirectTo);
                }
                break;
            case 4:
                if (auth()->user()->Gelanggang->jenis == 'Tanding') {
                    $this->redirectTo = route('juri.tanding');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Tunggal') {
                    $this->redirectTo = route('juri.tunggal');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Ganda') {
                    $this->redirectTo = route('juri.ganda');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Regu') {
                    $this->redirectTo = route('juri.regu');
                    return redirect($this->redirectTo);
                } else if (auth()->user()->Gelanggang->jenis == 'Solo Kreatif') {
                    $this->redirectTo = route('juri.solo');
                    return redirect($this->redirectTo);
                }
                break;
            default:
                $this->redirectTo = '/login';
                return redirect($this->redirectTo);
        }
    }
}
