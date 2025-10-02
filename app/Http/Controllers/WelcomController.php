<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Services\HelperService;
use Illuminate\Http\Request;
use App\Facades\Helper;
use Illuminate\Support\Facades\Route;


class WelcomController extends Controller
{
  protected $helper;
  public function __construct(HelperService $helper){
   $this->helper=$helper;

  }
 
    public function index(){

      return   $this->helper->greet('عاطف');

    }

    public function myfacade(){

      return Helper::greet('عاطف دياب محمد');

    }

    public function getmyrouteinfo($username){
    $name=Route::currentRouteName();
    $action = Route::currentRouteAction(); 
    $parm=Route::current()->parameters(); 




   return  "
    Route name : {$name} <br>
   Route Action : {$action} <br>
   Route parameters :  " .json_encode(  $parm); 

   
  
    }

}
