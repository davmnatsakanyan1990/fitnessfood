<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\SubPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function edit($title){
        $format_title = str_replace('_', ' ', $title);
        
        $page = Page::with('subPages')->where('title', $format_title)->first();
       return view('admin.pages.edit', compact('page'));
    }
}
