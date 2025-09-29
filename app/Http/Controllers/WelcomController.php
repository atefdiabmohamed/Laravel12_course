<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;


use Illuminate\Http\Request;

class WelcomController extends Controller
{
 
    public function index(){

      $helper=App::make('atefhi');
      return $helper->greet('عاطف');

    }
}
