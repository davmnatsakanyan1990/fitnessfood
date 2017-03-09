<?php

namespace App\Http\Controllers\Admin;

use App\Models\CardOrder;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CardOrderController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(Request $request){

        if($request->ajax()){
            if($request->has('trainer')){
                $orders = CardOrder::with(['promo_code' => function($promo_code) use ($request){
                    $promo_code->with('trainer');
                }])->whereHas('promo_code.trainer', function($query) use ($request){
                    $query->where('name', 'like', '%' . $request->trainer . '%');
                })->orderBy('created_at', 'desc')->get();;
            }
            else{
                $orders = CardOrder::with(['promo_code' => function($promo_code){
                    return $promo_code->with('trainer');
                }])->orderBy('created_at', 'desc')->get();
            }

            return view('ajax.card_orders_search', compact('orders'));
        }
        if($request->has('trainer')){
            $orders = CardOrder::with(['promo_code' => function($promo_code) use ($request){
                 $promo_code->with('trainer');
            }])->whereHas('promo_code.trainer', function($query) use ($request){
                $query->where('name', 'like', '%' . $request->trainer . '%');
            })->orderBy('created_at', 'desc')->get();;
        }
        else{
            $orders = CardOrder::with(['promo_code' => function($promo_code){
                return $promo_code->with('trainer');
            }])->orderBy('created_at', 'desc')->get();
        }

        $new_card_orders_array = collect($orders->toArray())->where('is_seen', '0')->pluck('id')->all();


        return view('admin.promo_codes.orders', compact('orders', 'new_card_orders_array'));
    }


    /**
     * Mark orders as seen
     *
     * @param Request $request
     */
    public function ordersSeen(Request $request){
        $orders = json_decode($request->new_orders);

        CardOrder::whereIn('id', $orders)->update(['is_seen'=>1]);
    }

    public function cardDataExport(Request $request){

        $data = [];
        $data['trainer'] = $request->trainer;
        $data['phone'] = $request->phone;
        $data['gym'] = $request->gym;
        $data['promo_code'] = $request->promo_code;
        $data['percent'] = $request->percent;

        $filename = time().$data['trainer'];

        Excel::create($filename, function($excel) use ($data) {

            $excel->sheet('Sheetname', function($sheet) use ($data){
                $sheet->row(1, array(
                    'Name', 'Phone', 'Gym', 'Promo Code', 'Percent'
                ));
                $sheet->row(2, $data);

                $sheet->freezeFirstRow();

            });

        })->store('xlsx', public_path('card_exports'));

        copy(public_path('images/trainerImages/'.$request->image_name), public_path('card_exports').'/'.$request->image_name);

        $files = glob(public_path('card_exports/*'));

        // remove existing zip
        if(is_file(public_path('mydir/card_data.zip')))
            unlink(public_path('mydir/card_data.zip'));

        Zipper::make('mydir/card_data.zip')->add($files)->close();

        $files = glob(public_path('card_exports/*')); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
        return response()->download(public_path('mydir/card_data.zip'));
    }
}
