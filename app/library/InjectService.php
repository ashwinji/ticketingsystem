<?php 
namespace App\library;
use App\User;
use App\PageInfo;
use Cookie;

class InjectService
{
	function getEmail($id)
	{
		return User::select('email','name','lastName','avatar')
				->where('id', $id)
				->first();
	}

	function getPageInfo($pageName)
	{	
		return PageInfo::where('pageName', $pageName)
				->first();
	}

	function getThemeClass()
	{
		if(Cookie::has('theme-color'))
		{
			return Cookie::get('theme-color');
		}
		return 'theme-black ls-closed';
	}
}

