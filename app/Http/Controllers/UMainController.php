<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Decoration_method;
use App\Models\Popup_setting;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Search;
use DB;
use Illuminate\Http\Request;
use Session;

class UMainController extends Controller
{
    public $num_per_page = 24;

    public function index()
    {
        $branddata = DB::select(DB::raw("SELECT id,brand_name,IF(num IS NULL,0,num) AS num
                                FROM
                                (SELECT b.*,a.num
                                FROM (SELECT * FROM brands WHERE STATUS = 1) b
                                LEFT JOIN (SELECT brand_name,COUNT(brand_name) AS num FROM products WHERE NOT brand_name = '' GROUP BY brand_name)a
                                ON a.brand_name = b.brand_name) c
                                ORDER BY brand_name"));

        $allcolor = Color::all();
        $colordata = [];
        foreach ($allcolor as $item) {
            $colordataval = [];
            $colornum = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE colors LIKE '%" . $item->color_name . "%'"));
            $colordataval['id'] = $item->id;
            $colordataval['color_name'] = $item->color_name;
            $colordataval['color_num'] = $colornum[0]->num;
            array_push($colordata, $colordataval);
        }

        $materialdata = DB::select(DB::raw("SELECT *
                        FROM
                        (SELECT b.*,IF(a.num IS NULL,0,a.num) AS num
                        FROM materials b
                        LEFT JOIN
                        (SELECT manufacturar,COUNT(manufacturar) AS num FROM products WHERE NOT manufacturar = '' GROUP BY manufacturar)a
                        ON a.manufacturar = b.name)c
                        ORDER BY c.name"));

        $alldecoration_method = Decoration_method::all();
        $decoration_methoddata = [];
        foreach ($alldecoration_method as $item) {
            $decoration_method_val = [];
            $decoration_method_num = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE decoration_method LIKE '%" . $item->id . "%'"));
            $decoration_method_val['id'] = $item->id;
            $decoration_method_val['name'] = $item->name;
            $decoration_method_val['num'] = $decoration_method_num[0]->num;
            array_push($decoration_methoddata, $decoration_method_val);
        }

        $discarddata = DB::select(DB::raw("SELECT id,name,IF(num IS NULL,0,num) AS num
                                    FROM
                                    (SELECT b.*,a.num
                                    FROM discards b
                                    LEFT JOIN (SELECT discount,COUNT(discount) AS num FROM products WHERE NOT discount = '' GROUP BY discount)a
                                    ON a.discount = b.name) c
                                    ORDER BY name"));

        $featureddata = DB::select(DB::raw("SELECT COUNT(featured) AS num FROM products WHERE featured = 1"));

        $onsaledata = DB::select(DB::raw("SELECT COUNT(onsale) AS num FROM products WHERE onsale = 1"));

        $category = Category::all();
        $categorydata = [];
        foreach ($category as $item) {
            $categorydataval = [];
            $categorynum = DB::select(DB::raw("SELECT category_id, COUNT(id) num FROM products WHERE category_id LIKE '" . $item->id . "' OR category_id LIKE '," . $item->id . "' OR category_id LIKE '" . $item->id . ",'"));
            $categorydataval['id'] = $item->id;
            $categorydataval['name'] = $item->category_name;
            $categorydataval['num'] = $categorynum[0]->num;

            $categorydataval['subcategory'] = [];
            $subcategory = DB::table('sub_categories')
                ->select('*')
                ->where('category_id', $item->id)
                ->get();
            foreach ($subcategory as $subitem) {
                $subcategory_val = [];
                $subcategory_val['id'] = $subitem->id;
                $subcategory_val['name'] = $subitem->subcategory_name;
                $subcategorynum = DB::select(DB::raw("SELECT subcategory_id, COUNT(id) num FROM products WHERE subcategory_id LIKE '" . $subitem->id . "' OR subcategory_id LIKE '," . $subitem->id . "' OR subcategory_id LIKE '" . $subitem->id . ",'"));
                $subcategory_val['num'] = $subcategorynum[0]->num;
                array_push($categorydataval['subcategory'], $subcategory_val);
            }

            array_push($categorydata, $categorydataval);
        }

        $productddata = [];
        $product_all = DB::select(DB::raw("SELECT COUNT(id) as id FROM products"));
        $product = DB::select(DB::raw("SELECT * FROM products ORDER BY featured DESC, RAND() LIMIT " . $this->num_per_page));
        foreach ($product as $item) {
            $product_list = [];
            $image = DB::table('product_images')
                ->select('product_image')
                ->where('product_id', $item->id)
                ->orderBy('img_order', 'ASC')
                ->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['description'] = $item->description;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($productddata, $product_list);
        }

        $brand = Brand::where('status', 1)->limit(30)->get();
        $allbrand = Brand::all();

        $popUp=Popup_setting::where('page_type',2)->where('status',1)->get();

        if(Session::get('popupProductCount') != '')
        {
            $oldSess=Session::get('popupProductCount');
            $newSess=$oldSess + 1;
            Session::put('popupProductCount',$newSess);
        }
        else
        {
            Session::put('popupProductCount',1);
        }
        
        Session::put('popupPage','product');

        return view('user.main')->with("brand", $brand)->with("allbrand", $allbrand)->with("branddata", $branddata)->with("colordata", $colordata)->with("decorationdata", $decoration_methoddata)->with("discarddata", $discarddata)->with("featureddata", $featureddata[0]->num)->with("onsaledata", $onsaledata[0]->num)->with("categorydata", $categorydata)->with("materialdata", $materialdata)->with("categoryparam", 0)->with("brandparam", "")->with("productddata", $productddata)->with("product_all", $product_all[0]->id)->with("key", '')->with('popup_data',$popUp);
    }

    public function search_product_api(Request $request)
    {
        $description = $request->input('description');
        if (strpos($description, "_lol_")) {
            $description = str_replace("_lol_", "/", $description);
        }

        $price_lower = $request->input('price_lower');
        $price_upper = $request->input('price_upper');
        $brand = $request->input('brand');
        $color = $request->input('color');
        $material = $request->input('material');
        $decoration = $request->input('decoration');
        $discount = $request->input('discount');
        $featured = $request->input('featured');
        $onsale = $request->input('onsale');
        $category = $request->input('category');
        $sorting = $request->input('sorting');
        $page = $request->input('page');
        $offset = ((int)$page - 1) * $this->num_per_page;

        //============================LEXAR PRODUCT SEARCH ENGIN=====================================

        // SELECT * FROM products
        // WHERE (category_id=2 AND subcategory_id=88 OR category_id=2 AND subcategory_id=93 OR category_id=33 AND subcategory_id=112) 
        // AND (brand_name = 'Movado' OR brand_name = 'iLUV')
        // AND (manufacturar = 'ABS Plastic' OR manufacturar = 'Stainless Steel')
        // AND (discount = 'R' OR discount = 'V')
        // AND (colors LIKE '%Black%' OR colors LIKE '%Silver%' OR colors LIKE '%Pink%')
        // AND (product_name LIKE '%Men%' OR DESCRIPTION LIKE '%Men%' OR specification LIKE '%Men%' OR note LIKE '%Men%' OR production_note LIKE '%Men%')
        // AND (decoration_method LIKE '%1%' OR decoration_method LIKE '%,1%' OR decoration_method LIKE '%1,%' OR decoration_method LIKE '%1%' OR decoration_method LIKE '%,1%' OR decoration_method LIKE '%1,%')
        // AND (featured = 1)
        // AND (onsale = 1)
        // AND price BETWEEN 0 AND 1
        // ORDER BY product_name
        // LIMIT 10 OFFSET 15

        //============================LEXAR PRODUCT SEARCH ENGIN=====================================

        $query = "SELECT * FROM
        (SELECT a.*,b.eqp
        FROM products a
        LEFT JOIN(SELECT product_id,MIN(price) AS eqp FROM product_prices GROUP BY product_id)b
        ON a.id = b.product_id) c";
        $count_category = 0;
        if ($category) {
            foreach ($category as $item) {
                if (count($item['subcategory'])) {
                    $count_category++;
                }
            }
        }

        if ($description || ($price_lower >= 0 && $price_upper > $price_lower) || $brand[0] != 'All' || $color[0] != 'All' || $material[0] != 'All' || $decoration[0] != 'All' || $discount[0] != 'All' || $featured || $onsale || $count_category) {
            $query .= " WHERE";
            $count = 0;
            if ($count_category) {
                $count_pos = 0;
                foreach ($category as $item) {
                    foreach ($item['subcategory'] as $subitem) {
                        if ($subitem && $subitem != 0) {
                            $count_pos++;
                        }
                    }
                }
                if ($count_pos) {
                    $query .= "(";
                    foreach ($category as $item) {
                        foreach ($item['subcategory'] as $subitem) {
                            if ($subitem && $subitem != 0) {
                                $query .= " category_id = " . $item['id'] . " AND subcategory_id = " . $subitem;
                                $query .= " OR ";
                            }
                        }
                    }
                    $query = chop($query, "OR ");
                    $query .= ")";
                    $count = 1;
                }

                $count_the = 0;
                foreach ($category as $item) {
                    foreach ($item['subcategory'] as $subitem) {
                        if ($subitem == 0) {
                            $count_the++;
                        }
                    }
                }

                if ($count_the) {
                    if ($count)
                        $query .= " OR";
                    $query .= "(";
                    foreach ($category as $item) {
                        foreach ($item['subcategory'] as $subitem) {
                            if ($subitem == 0) {
                                $query .= " category_id = " . $item['id'];
                                $query .= " OR ";
                            }
                        }
                    }
                    $query = chop($query, "OR ");
                    $query .= ")";
                    $count = 1;
                }
            }

            if ($brand[0] != 'All') {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                foreach ($brand as $item) {
                    $query .= " brand_name = '{$item}'";
                    $query .= " OR ";
                }
                $query = chop($query, "OR ");
                $query .= ")";
                $count = 1;
            }

            if ($material[0] != 'All') {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                foreach ($material as $item) {
                    $query .= " manufacturar = '{$item}'";
                    $query .= " OR ";
                }
                $query = chop($query, "OR ");
                $query .= ")";
                $count = 1;
            }

            if ($discount[0] != 'All') {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                foreach ($discount as $item) {
                    $query .= " discount = '{$item}'";
                    $query .= " OR ";
                }
                $query = chop($query, "OR ");
                $query .= ")";
                $count = 1;
            }

            if ($color[0] != 'All') {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                foreach ($color as $item) {
                    $query .= " colors LIKE '%{$item}%' OR colors LIKE '%,{$item}%' OR colors LIKE '%{$item},%'";
                    $query .= " OR ";
                }
                $query = chop($query, "OR ");
                $query .= ")";
                $count = 1;
            }

            if ($description) {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                $query .= " product_name LIKE '%" . addslashes($description) . "%' OR brand_name = '" . addslashes($description) . "' OR sku = '" . addslashes($description) . "'";
                $query .= ")";
                $count = 1;

                $today = date("Y-n-j H:i:s");
                $inputs = [
                    'keywords' => $description,
                    'created' => $today
                ];
                Search::insert($inputs);
            }

            if ($decoration[0] != 'All') {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                foreach ($decoration as $item) {
                    $query .= " decoration_method LIKE '%{$item}%' OR decoration_method LIKE '%,{$item}%' OR decoration_method LIKE '%{$item},%'";
                    $query .= " OR ";
                }
                $query = chop($query, "OR ");
                $query .= ")";
                $count = 1;
            }

            if ($featured) {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                $query .= " featured = 1";
                $query .= ")";
                $count = 1;
            }

            if ($onsale) {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                $query .= " onsale = 1";
                $query .= ")";
                $count = 1;
            }

            if ($price_lower >= 0 && $price_upper > $price_lower) {
                if ($count)
                    $query .= " AND";
                $query .= "(";
                $query .= " eqp BETWEEN {$price_lower} AND {$price_upper}";
                $query .= ")";
                $count = 1;
            }
        }

        $query .= " ORDER BY featured DESC, ";

        if ($sorting == 'name_asc') {
            $query .= " product_name ASC";
        } else if ($sorting == 'name_desc') {
            $query .= " product_name DESC";
        } else if ($sorting == 'price_asc') {
            $query .= " eqp ASC";
        } else if ($sorting == 'price_desc') {
            $query .= " eqp DESC";
        }
        $result_all = DB::select(DB::raw($query));

        $query .= " LIMIT {$this->num_per_page} OFFSET {$offset}";

        // echo $query;
        $search_result = [];
        $result = DB::select(DB::raw($query));
        foreach ($result as $item) {
            $product_list = [];
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->id)->orderBy('img_order', 'ASC')->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['description'] = $item->description;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($search_result, $product_list);
        }
        $productdata = [];
        $productdata['search_result'] = $search_result;
        $productdata['length'] = count($result_all);
        return $productdata;
    }

    public function search_by_brand_api($brandparam)
    {
        $branddata = DB::select(DB::raw("SELECT id,brand_name,IF(num IS NULL,0,num) AS num
                                FROM
                                (SELECT b.*,a.num
                                FROM (SELECT * FROM brands WHERE STATUS = 1) b
                                LEFT JOIN (SELECT brand_name,COUNT(brand_name) AS num FROM products WHERE NOT brand_name = '' GROUP BY brand_name)a
                                ON a.brand_name = b.brand_name) c
                                ORDER BY brand_name"));

        $allcolor = Color::all();
        $colordata = [];
        foreach ($allcolor as $item) {
            $colordataval = [];
            $colornum = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE colors LIKE '%" . $item->color_name . "%'"));
            $colordataval['id'] = $item->id;
            $colordataval['color_name'] = $item->color_name;
            $colordataval['color_num'] = $colornum[0]->num;
            array_push($colordata, $colordataval);
        }

        $materialdata = DB::select(DB::raw("SELECT *
                        FROM
                        (SELECT b.*,IF(a.num IS NULL,0,a.num) AS num
                        FROM materials b
                        LEFT JOIN
                        (SELECT manufacturar,COUNT(manufacturar) AS num FROM products WHERE NOT manufacturar = '' GROUP BY manufacturar)a
                        ON a.manufacturar = b.name)c
                        ORDER BY c.name"));

        $alldecoration_method = Decoration_method::all();
        $decoration_methoddata = [];
        foreach ($alldecoration_method as $item) {
            $decoration_method_val = [];
            $decoration_method_num = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE decoration_method LIKE '%" . $item->id . "%'"));
            $decoration_method_val['id'] = $item->id;
            $decoration_method_val['name'] = $item->name;
            $decoration_method_val['num'] = $decoration_method_num[0]->num;
            array_push($decoration_methoddata, $decoration_method_val);
        }

        $discarddata = DB::select(DB::raw("SELECT id,name,IF(num IS NULL,0,num) AS num
                                    FROM
                                    (SELECT b.*,a.num
                                    FROM discards b
                                    LEFT JOIN (SELECT discount,COUNT(discount) AS num FROM products WHERE NOT discount = '' GROUP BY discount)a
                                    ON a.discount = b.name) c
                                    ORDER BY name"));

        $featureddata = DB::select(DB::raw("SELECT COUNT(featured) AS num FROM products WHERE featured = 1"));

        $onsaledata = DB::select(DB::raw("SELECT COUNT(onsale) AS num FROM products WHERE onsale = 1"));

        $category = Category::all();
        $categorydata = [];
        foreach ($category as $item) {
            $categorydataval = [];
            $categorynum = DB::select(DB::raw("SELECT category_id, COUNT(id) num FROM products WHERE category_id LIKE '" . $item->id . "' OR category_id LIKE '," . $item->id . "' OR category_id LIKE '" . $item->id . ",'"));
            $categorydataval['id'] = $item->id;
            $categorydataval['name'] = $item->category_name;
            $categorydataval['num'] = $categorynum[0]->num;

            $categorydataval['subcategory'] = [];
            $subcategory = DB::table('sub_categories')->select('*')->where('category_id', $item->id)->get();
            foreach ($subcategory as $subitem) {
                $subcategory_val = [];
                $subcategory_val['id'] = $subitem->id;
                $subcategory_val['name'] = $subitem->subcategory_name;
                $subcategorynum = DB::select(DB::raw("SELECT subcategory_id, COUNT(id) num FROM products WHERE subcategory_id LIKE '" . $subitem->id . "' OR subcategory_id LIKE '," . $subitem->id . "' OR subcategory_id LIKE '" . $subitem->id . ",'"));
                $subcategory_val['num'] = $subcategorynum[0]->num;
                array_push($categorydataval['subcategory'], $subcategory_val);
            }

            array_push($categorydata, $categorydataval);
        }

        $product_all = DB::select(DB::raw("SELECT COUNT(id) as id FROM products WHERE brand_name='" . addslashes($brandparam) . "'"));
        $query = "SELECT * FROM products WHERE brand_name='" . addslashes($brandparam) . "' ORDER BY featured DESC, RAND() LIMIT {$this->num_per_page}";

        $productddata = [];
        $result = DB::select(DB::raw($query));
        foreach ($result as $item) {
            $product_list = [];
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->id)->orderBy('img_order', 'ASC')->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['description'] = $item->description;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($productddata, $product_list);
        }

        $brand = Brand::where('status', 1)->limit(30)->get();
        $allbrand = Brand::all();
        $popUp=Popup_setting::where('page_type',2)->where('status',1)->get();
         Session::put('popupProductCount','first');
        Session::put('popupPage','product');

        return view('user.main')->with("brand", $brand)->with("allbrand", $allbrand)->with("branddata", $branddata)->with("colordata", $colordata)->with("decorationdata", $decoration_methoddata)->with("discarddata", $discarddata)->with("featureddata", $featureddata[0]->num)->with("onsaledata", $onsaledata[0]->num)->with("categorydata", $categorydata)->with("materialdata", $materialdata)->with("categoryparam", 0)->with("brandparam", $brandparam)->with("productddata", $productddata)->with("product_all", $product_all[0]->id)->with("key", '')->with('popup_data',$popUp);
    }

    public function search_by_category_api($categoryparam)
    {
        $branddata = DB::select(DB::raw("SELECT id,brand_name,IF(num IS NULL,0,num) AS num
                                FROM
                                (SELECT b.*,a.num
                                FROM (SELECT * FROM brands WHERE STATUS = 1) b
                                LEFT JOIN (SELECT brand_name,COUNT(brand_name) AS num FROM products WHERE NOT brand_name = '' GROUP BY brand_name)a
                                ON a.brand_name = b.brand_name) c
                                ORDER BY brand_name"));

        $allcolor = Color::all();
        $colordata = [];
        foreach ($allcolor as $item) {
            $colordataval = [];
            $colornum = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE colors LIKE '%" . $item->color_name . "%'"));
            $colordataval['id'] = $item->id;
            $colordataval['color_name'] = $item->color_name;
            $colordataval['color_num'] = $colornum[0]->num;
            array_push($colordata, $colordataval);
        }

        $materialdata = DB::select(DB::raw("SELECT *
                        FROM
                        (SELECT b.*,IF(a.num IS NULL,0,a.num) AS num
                        FROM materials b
                        LEFT JOIN
                        (SELECT manufacturar,COUNT(manufacturar) AS num FROM products WHERE NOT manufacturar = '' GROUP BY manufacturar)a
                        ON a.manufacturar = b.name)c
                        ORDER BY c.name"));

        $alldecoration_method = Decoration_method::all();
        $decoration_methoddata = [];
        foreach ($alldecoration_method as $item) {
            $decoration_method_val = [];
            $decoration_method_num = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE decoration_method LIKE '%" . $item->id . "%'"));
            $decoration_method_val['id'] = $item->id;
            $decoration_method_val['name'] = $item->name;
            $decoration_method_val['num'] = $decoration_method_num[0]->num;
            array_push($decoration_methoddata, $decoration_method_val);
        }

        $discarddata = DB::select(DB::raw("SELECT id,name,IF(num IS NULL,0,num) AS num
                                    FROM
                                    (SELECT b.*,a.num
                                    FROM discards b
                                    LEFT JOIN (SELECT discount,COUNT(discount) AS num FROM products WHERE NOT discount = '' GROUP BY discount)a
                                    ON a.discount = b.name) c
                                    ORDER BY name"));

        $featureddata = DB::select(DB::raw("SELECT COUNT(featured) AS num FROM products WHERE featured = 1"));

        $onsaledata = DB::select(DB::raw("SELECT COUNT(onsale) AS num FROM products WHERE onsale = 1"));

        $category = Category::all();
        $categorydata = [];
        foreach ($category as $item) {
            $categorydataval = [];
            $categorynum = DB::select(DB::raw("SELECT category_id, COUNT(id) num FROM products WHERE category_id LIKE '" . $item->id . "' OR category_id LIKE '," . $item->id . "' OR category_id LIKE '" . $item->id . ",'"));
            $categorydataval['id'] = $item->id;
            $categorydataval['name'] = $item->category_name;
            $categorydataval['num'] = $categorynum[0]->num;

            $categorydataval['subcategory'] = [];
            $subcategory = DB::table('sub_categories')->select('*')->where('category_id', $item->id)->get();
            foreach ($subcategory as $subitem) {
                $subcategory_val = [];
                $subcategory_val['id'] = $subitem->id;
                $subcategory_val['name'] = $subitem->subcategory_name;
                $subcategorynum = DB::select(DB::raw("SELECT subcategory_id, COUNT(id) num FROM products WHERE subcategory_id LIKE '" . $subitem->id . "' OR subcategory_id LIKE '," . $subitem->id . "' OR subcategory_id LIKE '" . $subitem->id . ",'"));
                $subcategory_val['num'] = $subcategorynum[0]->num;
                array_push($categorydataval['subcategory'], $subcategory_val);
            }

            array_push($categorydata, $categorydataval);
        }

        $product_all = DB::select(DB::raw("SELECT COUNT(id) as id FROM products WHERE category_id='" . $categoryparam . "'"));
        $query = "SELECT * FROM products WHERE category_id='" . $categoryparam . "' ORDER BY featured DESC, RAND() LIMIT {$this->num_per_page}";

        $productddata = [];
        $result = DB::select(DB::raw($query));
        foreach ($result as $item) {
            $product_list = [];
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->id)->orderBy('img_order', 'ASC')->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['description'] = $item->description;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($productddata, $product_list);
        }

        $brand = Brand::where('status', 1)->limit(30)->get();
        $allbrand = Brand::all();
        $popUp=Popup_setting::where('page_type',2)->where('status',1)->get();
         Session::put('popupProductCount','first');
        Session::put('popupPage','product');

        return view('user.main')->with("brand", $brand)->with("allbrand", $allbrand)->with("branddata", $branddata)->with("colordata", $colordata)->with("decorationdata", $decoration_methoddata)->with("discarddata", $discarddata)->with("featureddata", $featureddata[0]->num)->with("onsaledata", $onsaledata[0]->num)->with("categorydata", $categorydata)->with("materialdata", $materialdata)->with("categoryparam", $categoryparam)->with("brandparam", '')->with("productddata", $productddata)->with("product_all", $product_all[0]->id)->with("key", '')->with('popup_data',$popUp);
    }

    public function search_by_key_api($key)
    {
        if (strpos($key, "_lol_")) {
            $key = str_replace("_lol_", "/", $key);
        }
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'keywords' => $key,
            'created' => $today
        ];
        Search::insert($inputs);

        $branddata = DB::select(DB::raw("SELECT id,brand_name,IF(num IS NULL,0,num) AS num
                                FROM
                                (SELECT b.*,a.num
                                FROM (SELECT * FROM brands WHERE STATUS = 1) b
                                LEFT JOIN (SELECT brand_name,COUNT(brand_name) AS num FROM products WHERE NOT brand_name = '' GROUP BY brand_name)a
                                ON a.brand_name = b.brand_name) c
                                ORDER BY brand_name"));

        $allcolor = Color::all();
        $colordata = [];
        foreach ($allcolor as $item) {
            $colordataval = [];
            $colornum = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE colors LIKE '%" . $item->color_name . "%'"));
            $colordataval['id'] = $item->id;
            $colordataval['color_name'] = $item->color_name;
            $colordataval['color_num'] = $colornum[0]->num;
            array_push($colordata, $colordataval);
        }

        $materialdata = DB::select(DB::raw("SELECT *
                        FROM
                        (SELECT b.*,IF(a.num IS NULL,0,a.num) AS num
                        FROM materials b
                        LEFT JOIN
                        (SELECT manufacturar,COUNT(manufacturar) AS num FROM products WHERE NOT manufacturar = '' GROUP BY manufacturar)a
                        ON a.manufacturar = b.name)c
                        ORDER BY c.name"));

        $alldecoration_method = Decoration_method::all();
        $decoration_methoddata = [];
        foreach ($alldecoration_method as $item) {
            $decoration_method_val = [];
            $decoration_method_num = DB::select(DB::raw("SELECT COUNT(id) num FROM products WHERE decoration_method LIKE '%" . $item->id . "%'"));
            $decoration_method_val['id'] = $item->id;
            $decoration_method_val['name'] = $item->name;
            $decoration_method_val['num'] = $decoration_method_num[0]->num;
            array_push($decoration_methoddata, $decoration_method_val);
        }

        $discarddata = DB::select(DB::raw("SELECT id,name,IF(num IS NULL,0,num) AS num
                                    FROM
                                    (SELECT b.*,a.num
                                    FROM discards b
                                    LEFT JOIN (SELECT discount,COUNT(discount) AS num FROM products WHERE NOT discount = '' GROUP BY discount)a
                                    ON a.discount = b.name) c
                                    ORDER BY name"));

        $featureddata = DB::select(DB::raw("SELECT COUNT(featured) AS num FROM products WHERE featured = 1"));

        $onsaledata = DB::select(DB::raw("SELECT COUNT(onsale) AS num FROM products WHERE onsale = 1"));

        $category = Category::all();
        $categorydata = [];
        foreach ($category as $item) {
            $categorydataval = [];
            $categorynum = DB::select(DB::raw("SELECT category_id, COUNT(id) num FROM products WHERE category_id LIKE '" . $item->id . "' OR category_id LIKE '," . $item->id . "' OR category_id LIKE '" . $item->id . ",'"));
            $categorydataval['id'] = $item->id;
            $categorydataval['name'] = $item->category_name;
            $categorydataval['num'] = $categorynum[0]->num;

            $categorydataval['subcategory'] = [];
            $subcategory = DB::table('sub_categories')->select('*')->where('category_id', $item->id)->get();
            foreach ($subcategory as $subitem) {
                $subcategory_val = [];
                $subcategory_val['id'] = $subitem->id;
                $subcategory_val['name'] = $subitem->subcategory_name;
                $subcategorynum = DB::select(DB::raw("SELECT subcategory_id, COUNT(id) num FROM products WHERE subcategory_id LIKE '" . $subitem->id . "' OR subcategory_id LIKE '," . $subitem->id . "' OR subcategory_id LIKE '" . $subitem->id . ",'"));
                $subcategory_val['num'] = $subcategorynum[0]->num;
                array_push($categorydataval['subcategory'], $subcategory_val);
            }

            array_push($categorydata, $categorydataval);
        }

        $product_all = DB::select(DB::raw("SELECT COUNT(id) as id FROM products WHERE product_name LIKE '%" . addslashes($key) . "%' OR brand_name = '" . addslashes($key) . "' OR sku = '" . addslashes($key) . "'"));
        $query = "SELECT * FROM products WHERE product_name LIKE '%" . addslashes($key) . "%' OR brand_name = '" . addslashes($key) . "' OR sku = '" . addslashes($key) . "' ORDER BY featured DESC, RAND() LIMIT {$this->num_per_page}";

        $productddata = [];
        $result = DB::select(DB::raw($query));
        foreach ($result as $item) {
            $product_list = [];
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->id)->orderBy('img_order', 'ASC')->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['description'] = $item->description;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($productddata, $product_list);
        }

        $brand = Brand::where('status', 1)->limit(30)->get();
        $allbrand = Brand::all();
        $popUp=Popup_setting::where('page_type',2)->where('status',1)->get();
         Session::put('popupProductCount','first');
        Session::put('popupPage','product');

        return view('user.main')->with("brand", $brand)->with("allbrand", $allbrand)->with("branddata", $branddata)->with("colordata", $colordata)->with("decorationdata", $decoration_methoddata)->with("discarddata", $discarddata)->with("featureddata", $featureddata[0]->num)->with("onsaledata", $onsaledata[0]->num)->with("categorydata", $categorydata)->with("materialdata", $materialdata)->with("categoryparam", 0)->with("brandparam", '')->with("productddata", $productddata)->with("product_all", $product_all[0]->id)->with("key", $key)->with('popup_data',$popUp);
    }
}
