<?php 
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
Class Helper extends Facade{

  protected static function getFacadeAccessor(): string

{

return \App\Services\HelperService::class;

}


}









