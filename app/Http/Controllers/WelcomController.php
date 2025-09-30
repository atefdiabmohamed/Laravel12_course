<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Services\HelperService;
use Illuminate\Http\Request;




class WelcomController extends Controller
{
  protected $helper;
  public function __construct(HelperService $helper){
   $this->helper=$helper;

  }
 
    public function index(){

      return   $this->helper->greet('عاطف');

    }
}
