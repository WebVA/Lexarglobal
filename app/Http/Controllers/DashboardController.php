<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Category;
use App\Models\State;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $product = DB::select(DB::raw("SELECT COUNT(id) as product FROM products"));
        $customer = DB::select(DB::raw("SELECT COUNT(id) as customer FROM customers"));
        $category = Category::all();
        $state = State::all();
        $data = DB::select(DB::raw("SELECT d.*
        FROM 
        (SELECT c.*,sub_categories.subcategory_name
                FROM 
                (SELECT b.*,categories.category_name
                FROM 
                (SELECT a.*,products.product_name, products.sku, products.brand_name, products.category_id, products.subcategory_id
                FROM
                (SELECT COUNT(id) AS view_count,product_id FROM product_viewes GROUP BY product_id ORDER BY view_count DESC)a
                LEFT JOIN products ON products.id = a.product_id)b
                LEFT JOIN categories ON b.category_id = categories.id)c
                LEFT JOIN sub_categories ON c.subcategory_id = sub_categories.id)d
                LIMIT 5"));

        $most_viewed_product = [];
        foreach ($data as $item) {
            $image = DB::table('product_images')
                ->select('product_image')
                ->where('product_id', $item->product_id)
                ->first();
            $count_year = date('Y') - 1;
            $count_month = date('m') + 1;
            $m_view_arry = [];
            for ($i = 1; $i <= 12; $i++) {
                if ($count_month == 12) {
                    $count_month = 0;
                    $count_year = date('Y');
                    //print_r(($count_year-1).'-'.'12-00'.' '.$count_year.'-01-00');
                    $m_view_data = DB::select(DB::raw("SELECT COUNT(id) AS m_view FROM product_viewes WHERE product_id={$item->product_id} AND view_date BETWEEN '" . ($count_year - 1) . '-12-00' . "' AND '" . $count_year . '-01-00' . "'"));
                    $count_month++;
                } else {
                    //print_r($count_year.'-'.$count_month.'-00'.$count_year.'-'.++$count_month.'-00');
                    $m_view_data = DB::select(DB::raw("SELECT COUNT(id) AS m_view FROM product_viewes WHERE product_id={$item->product_id} AND view_date BETWEEN '" . $count_year . '-' . $count_month . '-00' . "' AND '" . $count_year . '-' . ++$count_month . '-00' . "'"));
                }

                //echo("<br>");
                array_push($m_view_arry, $m_view_data[0]->m_view);
            }
            $result_val = [];
            $result_val['product_id'] = $item->product_id;
            $result_val['view_count'] = $item->view_count;
            $result_val['product_name'] = $item->product_name;
            $result_val['product_image'] = $image ? $image->product_image : "";
            $result_val['sku'] = $item->sku;
            $result_val['brand_name'] = $item->brand_name;
            $result_val['category_name'] = $item->category_name;
            $result_val['subcategory_name'] = $item->subcategory_name;
            $result_val['m_view_arry'] = $m_view_arry;
            array_push($most_viewed_product, $result_val);
        }
        $search_data = DB::select(DB::raw("SELECT *,COUNT(keywords) AS num FROM search GROUP BY keywords ORDER BY num DESC LIMIT 10"));
        $new_customer = DB::select(DB::raw("SELECT * FROM customers ORDER BY created DESC LIMIT 5"));
        $top_customer = DB::select(DB::raw("SELECT a.*,customers.firstname, customers.lastname, customers.state
                                            FROM
                                            (SELECT customer_id, COUNT(customer_id) AS view_count FROM product_viewes GROUP BY customer_id ORDER BY view_count DESC LIMIT 5)a
                                            LEFT JOIN customers ON customers.id = a.customer_id"));
        $new_product_pre = DB::select(DB::raw("SELECT * FROM products ORDER BY created DESC LIMIT 5"));
        $new_product = [];
        foreach ($new_product_pre as $item) {
            $image = DB::table('product_images')
                ->select('product_image')
                ->where('product_id', $item->id)
                ->first();
            $result_val = [];
            $result_val['id'] = $item->id;
            $result_val['product_name'] = $item->product_name;
            $result_val['product_image'] = $image ? $image->product_image : "";
            $result_val['sku'] = $item->sku;
            $result_val['brand_name'] = $item->brand_name;
            $result_val['created'] = $item->created;
            $result_val['price'] = $item->price;
            array_push($new_product, $result_val);
        }
        $query = "SELECT * FROM sample_orders limit 10";
        $sample_order = DB::select(DB::raw($query));
        return view('dashboard.home')
            ->with("product", $product[0]->product)
            ->with("customer", $customer[0]->customer)
            ->with("most_viewed_product", $most_viewed_product)
            ->with("search_data", $search_data)
            ->with("new_customer", $new_customer)
            ->with("top_customer", $top_customer)
            ->with("new_product", $new_product)
            ->with("sample_order", $sample_order);
    }
}
