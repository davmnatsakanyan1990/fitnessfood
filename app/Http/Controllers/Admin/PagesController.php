<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
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
        
        $page = Page::where('title', $format_title)->first();
       return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id){
        Page::where('id', $id)->update(['content' => json_encode($request->data, JSON_UNESCAPED_UNICODE)]);
    }
}
