<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubPage;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubPageController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function update(Request $request, $sub_id){
        SubPage::where('id', $sub_id)->update(['content' => json_encode($request->data['content'], JSON_UNESCAPED_UNICODE), 'title' => json_encode($request->data['title'])]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'title.en' => 'required'
        ]);

        SubPage::create(['title' => json_encode($request->title), 'content' => json_encode($request->contents), 'page_id' => $request->page_id]);

        return redirect()->back()->with('message', 'Sub-Page has been created successfully');
    }

    public function delete($id){
        SubPage::where('id', $id)->delete();
    }
}
