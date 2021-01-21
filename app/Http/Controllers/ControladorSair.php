<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TokenStore\TokenCache;
class ControladorSair extends Controller
{
    public function Sair(){
        $tokenCache = new TokenCache();
        $tokenCache->clearTokens();
        session()->flush();
        return redirect('/');
    }
}
