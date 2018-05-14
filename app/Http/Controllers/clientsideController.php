<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Product;
use App\Cart;
use App\Order;
use Mail;
use App\Mail\NewOrder;
use App\Mail\Contact;
use Session;

class clientsideController extends Controller
{

  public function home(){
    $data = [
      'categories' => Category::all(),
      'products' => Product::all(),
      'popularProducts' => Product::orderBy('orders','desc')->take(3)->get(),
      'newProducts' => Product::orderBy('id','desc')->take(3)->get()
    ];
    return view('client.index')->with($data);
  }
  public function contact($value=''){
    $data = [
      'categories' => Category::all(),
      'products' => Product::all()
    ];
    return view('client.contact')->with($data);
  }
  public function dropMessage(Request $request){
    Mail::to(config('app.mail'))->send(new Contact($request));
    Session::flash('message', 'Your message was sent');
    return redirect(url('contact'));
  }
  public function showProduct($slug){
    $requestedProduct = Product::where('slug', '=' , $slug)->first();
    $data = [
      'categories' =>  Category::all(),
      'products' => Product::all(),
      'intersetedProducts' => Product::where('slug', '!=' , $slug)->where('category',  $requestedProduct->category)->get(),
      'requestedProduct' => $requestedProduct
    ];
    return view('client.products.singleProduct')->with($data);
  }

  public function productsInCategory($name){
    $data = [
      'categories' =>  Category::all(),
      'products' => Product::all(),
      'requestedProducts' => Product::where('category', '=' , $name)->get()
    ];
    return view('client.products.productsInCat')->with($data);
  }

  public function searchProduct(Request $request){
    $data = [
      'categories' => Category::all(),
      'products' => Product::all(),
      'requestedProducts' => Product::where('name','like', '%' . $request->input('searchInput') . '%')->get()
    ];

    return view('client.products.searchResults')->with($data);
  }

  public function productsType($type){
    if($type == "New"){
      $requestedProducts = Product::orderBy('id','desc')->get();
    }elseif($type == "Popular"){
      $requestedProducts = Product::orderBy('orders','desc')->get();
    }else{
      $requestedProducts = "";
    }
    $data = [
      'categories' => Category::all(),
      'products' => Product::all(),
      'requestedProducts' => $requestedProducts
    ];
    return view('client.products.productsInType')->with($data);
  }

  public function addToCart(Request $request){
    $product = Product::find($request->input('p_id'));
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $cart->add($product, $product->id);
    $request->session()->put('cart', $cart);
    return redirect()->back();
  }

  public function showCart(){
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    (Session::has('cart')) ? $cartItems = $cart->items : $cartItems = null;
    (Session::has('cart')) ? $totalPrice = $cart->totalPrice : $totalPrice = null;
    $data = [
      'categories' => Category::all(),
      'products' => Product::all(),
      'cartItems' => $cartItems,
      'totalPrice' => $totalPrice
    ];
    return view('client.products.showCart')->with($data);
  }

  public function removeFromCart(Request $request){
    $product = Product::find($request->input('removeItem_id'));
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $cart->delete($product, $product->id, $request->input('removeItem_qtty'));
    $request->session()->put('cart', $cart);
    return redirect()->back();
  }

  public function updateCart(Request $request){
    $product = Product::find($request->input('item_id'));
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $cart->update($product, $product->id,  $request->input('item_old_qtty') , $request->input('item_qtty'));
    $request->session()->put('cart', $cart);
    return redirect()->back();
  }

  public function placeOrder(){

    if((Auth::user()) && (Auth::user()->address != null) && (Auth::user()->phone != null)){
      $order = Order::create([
        'cart' => serialize(Session::get('cart')),
        'buyer_name' => Auth::user()->name,
        'buyer_email' => Auth::user()->email,
        'buyer_address' => Auth::user()->address,
        'buyer_phone' => Auth::user()->phone
      ]);
      Mail::to(config('app.mail'))->send(new NewOrder());
      Session::forget('cart');
      Session::flash('message','Your Order is Placed!');
      return redirect(url('products/show-cart'));
    }else{
      if(!Auth::user()){
        Session::flash('message','Please Login to Place Order');
        return redirect((url('login')));
      }elseif((Auth::user()->address == null) && (Auth::user()->phone == null)){
        Session::flash('message','Please Complete Profile to Place Order');
        return redirect((url('home')));
      }else{
        Session::flash('message','Unknown Error Occurd');
        return redirect((url('/')));
      }
    }

  }

  public function logoutErrorFix(){
    return redirect(url('/'));
  }

}
