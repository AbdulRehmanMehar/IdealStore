<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use Session;
use Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('preventBackHistory');
      $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
    /*
    |--------------------------------------------------------------------------
    | Credentials Area
    |--------------------------------------------------------------------------
    */
    public function showCredentials()
    {
      $url = base_path('.env');
      $fh = fopen($url,'r');
      while($line = fgets($fh)) {
        $a = explode( '=', $line);
        if($a[0] == "APP_NAME"){$APP_NAME = str_replace("'", "" ,$a[1]);}
        if($a[0] == "APP_DESC"){$APP_DESC = str_replace("'", "" ,$a[1]);}
        if($a[0] == "DB_DATABASE"){$DB_DATABASE = $a[1];}
        if($a[0] == "DB_USERNAME"){$DB_USERNAME = $a[1];}
        if($a[0] == "DB_PASSWORD"){$DB_PASSWORD = $a[1];}
        if($a[0] == "MAIL_HOST"){$MAIL_HOST = $a[1];}
        if($a[0] == "MAIL_USERNAME"){$MAIL_USERNAME = $a[1];}
        if($a[0] == "MAIL_PASSWORD"){$MAIL_PASSWORD = $a[1];}
        if($a[0] == "MAIL_FROM_ADDRESS"){$MAIL_FROM_ADDRESS = $a[1];}
        if($a[0] == "MAIL_FROM_NAME"){$MAIL_FROM_NAME = str_replace("'", "" ,$a[1]);}
        if($a[0] == "GOOGLE_CID"){$GOOGLE_CID = $a[1];}
        if($a[0] == "GOOGLE_CSECRET"){$GOOGLE_CSECRET = $a[1];}
        if($a[0] == "FB_CID"){$FB_CID = $a[1];}
        if($a[0] == "FB_CSECRET"){$FB_CSECRET = $a[1];}
        if($a[0] == "TWITTER_CID"){$TWITTER_CID = $a[1];}
        if($a[0] == "TWITTER_CSECRET"){$TWITTER_CSECRET = $a[1];}
      }
      $data = array(
        "APP_NAME" => $APP_NAME,
        "APP_DESC" => $APP_DESC,
        "DB_DATABASE" => $DB_DATABASE,
        "DB_USERNAME" => $DB_USERNAME,
        "DB_PASSWORD" => $DB_PASSWORD,
        "MAIL_HOST" => $MAIL_HOST,
        "MAIL_USERNAME" => $MAIL_USERNAME,
        "MAIL_PASSWORD" => $MAIL_PASSWORD,
        "MAIL_FROM_NAME" => $MAIL_FROM_NAME,
        "MAIL_FROM_ADDRESS" => $MAIL_FROM_ADDRESS,
        "GOOGLE_CID" => $GOOGLE_CID,
        "GOOGLE_CSECRET" => $GOOGLE_CSECRET,
        "FB_CID" => $FB_CID,
        "FB_CSECRET" => $FB_CSECRET,
        "TWITTER_CID" => $TWITTER_CID,
        "TWITTER_CSECRET" => $TWITTER_CSECRET
      );
      fclose($fh);
      return view('admin.credentials')->with($data);

    }

    protected function replace_string_in_file($filename, $string_to_replace, $replace_with){
      $content=file_get_contents($filename);
      $content_chunks=explode($string_to_replace, $content);
      $content=implode($replace_with, $content_chunks);
      file_put_contents($filename, $content);
    }

    protected function addQuotes($str){
        return "'$str'";
    }

    public function saveCredentials(Request $request)
    {
      $url = base_path('.env');
      $fh = fopen($url,'r');
      while($line = fgets($fh)) {
        $a = explode( '=', $line);
        if($a[0] == "APP_NAME"){$this->replace_string_in_file($url,$a[1], $this->addQuotes($request->input('APP_NAME')) . "\n" );}
        if($a[0] == "APP_DESC"){$this->replace_string_in_file($url,$a[1], $this->addQuotes($request->input('APP_DESC')) . "\n" );}
        if($a[0] == "DB_DATABASE"){$this->replace_string_in_file($url,$a[1],$request->input('DB_DATABASE') . "\n" );}
        if($a[0] == "DB_USERNAME"){$this->replace_string_in_file($url,$a[1],$request->input('DB_USERNAME') . "\n" );}
        if($a[0] == "DB_PASSWORD"){$this->replace_string_in_file($url,$a[1],$request->input('DB_PASSWORD') . "\n" );}
        if($a[0] == "MAIL_HOST"){$this->replace_string_in_file($url,$a[1],$request->input('MAIL_HOST') . "\n" );}
        if($a[0] == "MAIL_USERNAME"){$this->replace_string_in_file($url,$a[1],$request->input('MAIL_USERNAME') . "\n" );}
        if($a[0] == "MAIL_PASSWORD"){$this->replace_string_in_file($url,$a[1],$request->input('MAIL_PASSWORD') . "\n" );}
        if($a[0] == "MAIL_FROM_NAME"){$this->replace_string_in_file($url,$a[1],$this->addQuotes($request->input('MAIL_FROM_NAME')) . "\n" );}
        if($a[0] == "MAIL_FROM_ADDRESS"){$this->replace_string_in_file($url,$a[1],$request->input('MAIL_FROM_ADDRESS') . "\n" );}
        if($a[0] == "GOOGLE_CID"){$this->replace_string_in_file($url,$a[1],$request->input('GOOGLE_CID') . "\n" );}
        if($a[0] == "GOOGLE_CSECRET"){$this->replace_string_in_file($url,$a[1],$request->input('GOOGLE_CSECRET') . "\n" );}
        if($a[0] == "FB_CID"){$this->replace_string_in_file($url,$a[1],$request->input('FB_CID') . "\n" );}
        if($a[0] == "FB_CSECRET"){$this->replace_string_in_file($url,$a[1],$request->input('FB_CSECRET') . "\n" );}
        if($a[0] == "TWITTER_CID"){$this->replace_string_in_file($url,$a[1],$request->input('TWITTER_CID') . "\n" );}
        if($a[0] == "TWITTER_CSECRET"){$this->replace_string_in_file($url,$a[1],$request->input('TWITTER_CSECRET') . "\n" );}
      }
      fclose($fh);
      return redirect('admin/showcredentials');
    }
    /*
    |--------------------------------------------------------------------------
    | Categories Area
    |--------------------------------------------------------------------------
    */
    public function showCategories()
    {
      $categories = Category::all();
      return view('admin.categories')->with('categories' , $categories);
    }

    public function addCategory(Request $request)
    {

      $category = Category::create([
        'name' => $request->input('c_name'),
        'parent' => $request->input('c_parent')
      ]);
      return redirect('admin/categories');
    }

    public function updateCategory(Request $request)
    {
      $update = Category::where('id' , $request->input('u_id'))->first();
      $update->name = $request->input('u_name');
      $update->parent = $request->input('u_parent');
      $update->save();
      return redirect('admin/categories');
    }
    public function deleteCategory(Request $request){
      $delete = Category::findOrFail($request->input('d_id'));
      $delete->delete();
      return redirect('admin/categories');
    }
    /*
    |--------------------------------------------------------------------------
    | Products Area
    |--------------------------------------------------------------------------
    */
    public function showProducts(){
      $data = [
        'categories' => Category::all(),
        'products' => Product::all()
      ];
      return view('admin.products')->with($data);
    }
    public function addProduct(Request $request){
      if($request->hasFile('p_image')){
        $name = $request->file('p_image')->getClientOriginalName();
        $ext = $request->file('p_image')->getClientOriginalExtension();
        $name2store = str_replace(" ","-",$request->input('p_name')) . '.' . $ext;
        $path = $request->file('p_image')->storeAs('public/product_images', $name2store);
      }else{
        $name2store = "default.jpeg";
      }
      $product = Product::create([
        'name' => $request->input('p_name'),
        'price' => $request->input('p_price'),
        'details' => $request->input('p_details'),
        'category' => $request->input('p_category'),
        'images' => $name2store,
        'slug' => str_replace(" ", "-", $request->input('p_name'))
      ]);
      return redirect('admin/products');
    }
    public function updateProduct(Request $request){
      // Checking for the file
      if($request->hasFile('u_image')){
        $name = $request->file('u_image')->getClientOriginalName();
        $ext = $request->file('u_image')->getClientOriginalExtension();
        $name2store = str_replace(" ","-",$request->input('u_name')) . '.' . $ext;
        $path = $request->file('u_image')->storeAs('public/product_images', $name2store);
      }else{
        $products = Product::all();
        foreach ($products as $product) {
          if($product->id == $request->input('u_id')){
            $name2store = $product->images;
          }else{
            $name2store = "default.jpeg";
          }
        }
      }
      $update = Product::where('id' , $request->input('u_id'))->first();
      $update->name = $request->input('u_name');
      $update->price = $request->input('u_price');
      $update->details = $request->input('u_details');
      $update->category = $request->input('u_category');
      $update->images = $name2store;
      $update->save();
      return redirect('admin/products');
    }
    public function deleteProduct(Request $request){
      $delete = Product::findOrFail($request->input('d_id'));
      if($delete->images != "default.jpeg"){
        Storage::delete('public/product_images/' .$delete->images);
      }
      $delete->delete();
      return redirect('admin/products');
      return ;
    }
}
