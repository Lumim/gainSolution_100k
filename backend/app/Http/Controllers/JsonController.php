<?php

namespace App\Http\Controllers;
use DB;
use Storage;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariants;

class JsonController extends Controller
{
    public function store_json(){
        DB::beginTransaction();
        try {
          
            $json = Storage::disk('local')->get('test.json');
            $data = json_decode($json, true);
            
            //dd($data);
            foreach($data as $key=>$value){
                //dd($value);
                $product=Product::create(array(
                    'name'=>$value['NAME'],
                    'category'=>$value['CATEGORY'],
                    'product_type'=>$value['PRODUCT_TYPE'],
                    'sku'=>$value['SKU'],
                    'barcode'=>$value['BARCODE'],
                    'price'=>$value['PRICE']
                ));

                ProductVariants::create(array(
                    'product_id'=>$product->id,
                    'variant_name'=>$value['VARIANT_NAME'],
                    'variant_value'=>$value['VARIANT_VALUE']
                ));
            }

            DB::commit();
            return response()->json(['message'=>'success']);
        

             
        } catch (\Throwable $e) {
            DB::rollback();
            $message="Message: ".$e->getMessage().",File:".$e->getFile().",Line:".$e->getLine();
            return response()->json($message);
        }
    }
}
