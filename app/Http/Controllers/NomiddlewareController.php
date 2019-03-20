<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class NomiddlewareController extends Controller
{
    public function setCookiesTheme(Request $request)
    {
    	$cookie = Cookie::queue('theme-color', $request->name, 60*30);
    	return $cookie;
    }
}
