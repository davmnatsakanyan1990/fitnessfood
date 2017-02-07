<?php
namespace App\Http\ViewComposers;

use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;


class BasketComposer
{
    
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $locale = App::getLocale();

        // get basket items
        if(isset($_COOKIE['basket'])) {
            $pds = json_decode($_COOKIE['basket']);
        }
        else{
            $pds = [];
        }

        $basket_products = array();
        $total = 0;
        if(count($pds) > 0) {
            foreach ($pds as $item) {
                $product = Product::with('thumb_image')->find($item->product_id)->toArray();
                $product['count'] = $item->count;
                $total += $item->count * $product['price'];
                $product['title'] = json_decode($product['title'])->$locale;

                array_push($basket_products, $product);
            }
        }
        $view->with('basket_products', $basket_products);
    }
}