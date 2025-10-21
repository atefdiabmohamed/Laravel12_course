<?php

use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StundetController;
use App\Http\Controllers\Training_coursesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomController;
use App\Models\Flight;
use App\Models\Training_courses;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


Route::get('dashboard',function(){
    return "welcome Atef From Wep route file";
})->middleware(['throttle:lmit5']);

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('ar',function(){
session()->put('locale','ar');
return redirect()->back();
})->name('ar');

Route::get('en',function(){
session()->put('locale','en');
return redirect()->back();
})->name('en');

Route::get('yourname/{name}',function($name){
    return "welcome"." ".$name;
});

Route::get('yourname/{name?}',function($name="atef"){
    return "welcome"." ".$name;
})->middleware('PoliceMan');

Route::get('login',function(){
    return view('login',['name'=>'atef']);
});
Route::get('getlogin',[LoginController::class,'getlogin']);

Route::get('page1',function(){
    return view('page1');
});

Route::get('article',function(){
    return view('article');
});
Route::get('flights',[FlightsController::class,'index'])->name('flights');
Route::get('create_flights',[FlightsController::class,'create'])->name('create_flights');
Route::post('store_flight',[FlightsController::class,'store'])->name('store_flight');
Route::get('edit_flights/{id}',[FlightsController::class,'edit'])->name('edit_flights');
Route::post('update_flights/{id}',[FlightsController::class,'update_flights'])->name('update_flights');
Route::get('delete_flights/{id}',[FlightsController::class,'delete_flights'])->name('delete_flights');
Route::get('delete_soft/{id}',[FlightsController::class,'delete_soft'])->name('delete_soft');
Route::get('restore/{id}',[FlightsController::class,'restore'])->name('restore');
//start courses
Route::get('courses',[CoursesController::class,'index'])->name('courses.index');
Route::get('create_courses',[CoursesController::class,'create'])->name('courses.create');
Route::post('store_courses',[CoursesController::class,'store'])->name('courses.store');
Route::get('edit_courses/{id}',[CoursesController::class,'edit'])->name('courses.edit');
Route::post('update_courses/{id}',[CoursesController::class,'update'])->name('courses.update');
Route::get('destroy_courses/{id}',[CoursesController::class,'destroy'])->name('courses.destroy');
Route::get('testurl',[CoursesController::class,'testurl'])->name('training_courses.testurl');



//start Students
Route::get('student',[StundetController::class,'index'])->name('student.index');
Route::get('create_student',[StundetController::class,'create'])->name('student.create');
Route::post('store_student',[StundetController::class,'store'])->name('student.store');
Route::get('edit_student/{id}',[StundetController::class,'edit'])->name('student.edit');
Route::post('update_student/{id}',[StundetController::class,'update'])->name('student.update');
Route::get('destroy_student/{id}',[StundetController::class,'destroy'])->name('student.destroy');
Route::post('ajax_search_student',[StundetController::class,'ajax_search_student'])->name('student.ajax_search_student');
//start training_courses
Route::get('training_courses',[Training_coursesController::class,'index'])->name('training_courses.index');
Route::get('create_training_courses',[Training_coursesController::class,'create'])->name('training_courses.create');
Route::post('store_training_courses',[Training_coursesController::class,'store'])->name('training_courses.store');
Route::get('edit_training_courses/{id}',[Training_coursesController::class,'edit'])->name('training_courses.edit');
Route::post('update_training_courses/{id}',[Training_coursesController::class,'update'])->name('training_courses.update');
Route::get('destroy_training_courses/{id}',[Training_coursesController::class,'destroy'])->name('training_courses.destroy');
Route::get('details_training_courses/{id}',[Training_coursesController::class,'details'])->name('training_courses.details');
Route::get('AddStudentToTrainingCourses/{id}',[Training_coursesController::class,'AddStudentToTrainingCourses'])->name('training_courses.AddStudentToTrainingCourses');
Route::post('DOAddStudentToTrainingCourses/{id}',[Training_coursesController::class,'DOAddStudentToTrainingCourses'])->name('training_courses.DOAddStudentToTrainingCourses');
Route::get('DeleteStudentFromTrainingCourses/{id}',[Training_coursesController::class,'DeleteStudentFromTrainingCourses'])->name('training_courses.DeleteStudentFromTrainingCourses');

Route::resource('country', CountriesController::class);
Route::get('welcome',[WelcomController::class,'index']);
// Route Redirect Example
Route::redirect('here1', 'https://www.google.com/?zx=1759435648077&no_sw_cr=1');
Route::permanentRedirect('here2', 'https://www.google.com/?zx=1759435648077&no_sw_cr=1');
//Accessing the Current Route
Route::get('getmyrouteinfo/{username}',[WelcomController::class,'getmyrouteinfo'])->name('get_my_route_info');

Route::get('testcacheaffect1',function(){
    return "cahce ";
});

//Interacting With The Request

Route::get('/testRquest',function (Request $request){
 //return $request->all();
 /*return [
'path'=>$request->path(),
'url'=>$request->url(),
'host'=>$request->host(),
'method'=>$request->method(),
'ip'=>$request->ip(),




 ]; */

//return  $request->header('User-Agent');

//return $request->header('X-App-Name','AtefSoft');

//return $contentTypes = $request->getAcceptableContentTypes();;

/*if ($request->hasHeader('X-Header-Name')) {

    return "Found";


}else{
    return "Not Found";   
}*/

/*if($request->header('AppKey')=="atef"){
return response()->json(['data'=>'Success operation']);
}else{
return response()->json(['data'=>'Faild Authoiztion operation']);
}
*/

});

//send header
Route::get('/sendMyHeaders',function(Request $request){
return response('Hello Atef Soft ')
->header('AppName','Pos')
->header('Version','3');

});

Route::get('/SendHeaderToMe',function(Request $request){
$request->headers->set('XAppNAme','AtefSoft From More info Header');
$headerValue=$request->header('XAppNAme');
return " القيم الاضافية في الهيدر هي ".$headerValue;


});

//Content Negotiation
Route::get('ContentNegotiation',function(Request $request){

//$contentTypes = $request->getAcceptableContentTypes();
/*if ($request->accepts(['text/html', 'application/json'])) {
return " Accept html , json";

}else{

return " not Accept html , json";
} 
*/
/*$preferred = $request->prefers([ 'application/json','text/html']);
return " النوع المفضل لدي".$preferred;
*/

if ($request->expectsJson()) {
return response()->json(['key'=>'value']);
 
}else{
    return " حرجع شيء اخر";

}


});

Route::get('psr7',function(ServerRequestInterface $request){
$method=$request->getMethod();
$uri=$request->getUri();
$headers=$request->getHeaders();

return response()->json([
'method'=>$method,
'uri'=>$uri,
'headers'=>$headers


]);

});

// Response Section

Route::get('/simple_response_string', function () {

    return 'Hello World';

});
Route::get('simple_response_array/', function () {

    return [1, 2, 3];

});

Route::get('/response_with_header', function () {

    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');

});

Route::get('/user/{user}', function (User $user) {

    return $user;

});

Route::get('/return_multi_headers', function () {

return response("Multi Headers")

    ->header('Content-Type', "json")

    ->header('X-Header-One', 'Header Value')

    ->header('X-Header-Two', 'Header Value');

});

Route::get('/return_multi_headers_array', function () {

return response("array of headers")

    ->withHeaders([

        'Content-Type' => "HTml",

        'X-Header-One' => 'Header Value',

        'X-Header-Two' => 'Header Value',

    ]);

});


Route::get('/return_cookie', function () {

return response('Hello World cookie')->cookie(

    'atefsoft', 'programming', 30,'/',null,true,true

);

});

Cookie::queue('color', 'red', 60);
Cookie::expire('atefsoft');

Route::get('/readycookie', function () {
$cookie = cookie('size', '41', 60);
return response('Hello World cookie')->cookie($cookie);

});

Route::get('remove_cookie', function () {

return response('Hello World cookie')->withoutCookie('atefsoft');

});

Route::get('redirect_dashboard', function () {

    return redirect('/dashboard');

});

Route::get('return_redirect_to_route', function () {

   return redirect()->route('courses.index');
});


Route::get('return_redirect_add_course', function () {

return redirect()->action([CoursesController::class, 'create']);
});

Route::get('return_redirect_edit_course', function () {

return redirect()->action([CoursesController::class, 'edit'], ['id' => 1]);
});

Route::get('return_External_Domains', function () {

  return redirect()->away('https://www.google.com');
});

Route::get('return_view',function(){
return response()->view('hello_view',['name'=>'atefsoft'],200)->header('Content-Type','text/html');

});
Route::get('return_json_data',function(){
return response()->json([

    'name' => 'Abigail',

    'state' => 'CA',

]);

});

Route::get('jsonp',function(Request $request){
 return response()->json([

    'name' => 'atefsoft',

    'state' => '200',

])->withCallback($request->input('callback'));


});

Route::get('force_download_file',function(){

    return response()->download(public_path('atef.pdf'),'force download 2',['Content-Type'=>'application/pdf']);
});
Route::get('show_file',function(){

    return response()->file(public_path('atef.pdf'));
});

Route::get('/stream', function () {

    return response()->stream(function (): void {

        foreach (['developer', 'admin','accountant','editor','doctor'] as $string) {

            echo $string."<br>";

            ob_flush();

            flush();

            sleep(2); // Simulate delay between chunks...

        }

    }, 200, ['X-Accel-Buffering' => 'no']);

});
Route::get('test_macro',function(){
return response()->caps('foo');

});

 

Route::get('/unsubscribe/{user}', function (Request $request) {

    if (! $request->hasValidSignature()) {

        abort(401);

    }
    return "تم الغاء الاشتراك بنجاح ";

})->name('unsubscribe');



Route::get('send_email_ver',function(){

$url=URL::temporarySignedRoute(
    'unsubscribe', now()->addMinutes(1), ['user' => 1]
);

return " رابط الالغاء الخاص بكم  : <a href='{$url}'> {$url} </a> " ;




});

//Request
Route::get('set_session', function (Request $request) {
    $request->session()->put('username','Atef Diab Mohamed');
    $request->session()->put('user_id',1);
    $request->session()->put('role',"admin");
    return " لقد تم تخزين الجلسات في الداتابيس ";

});
//Request
Route::get('get_session', function (Request $request) {
    $username=$request->session()->get('username','غير معرف');
    $id=$request->session()->get('user_id','غير معرف');
    $role=$request->session()->get('role','غير معرف');
    return " اسم المستخدم".$username." بصلاحية ".$role." برقم كود ".$id;


});

//Glopal Helper session

Route::get('set_session_by_helper', function () {
   session(['the_name'=>'atef','theid'=>5]);
    return " لقد تم تخزين الجلسات في الداتابيس ";
});

Route::get('get_session_by_helper', function () {
 $username=session('the_name','لايوجد');
  $theid=session('theid','لايوجد');

     return " اسم المستخدم".$username."برقم كود ".$theid;
});

//Facade Session
Route::get('set_session_by_Facade', function () {
   Session::put('user','atef');
   Session::put('type','admin');
    return " لقد تم تخزين الجلسات في الداتابيس ";
});


Route::get('get_session_by_Facade', function () {
 $user=Session::get('user','لايوجد');
  $type=Session::get('type','لايوجد');

     return " اسم المستخدم".$user." بنوع ".$type;
});

//flash data - flash session

Route::get('/flash_data',function(Request $request){
$request->session()->flash('status','  هذه رسالة مؤقته للطلب الحالي فقط !');
return view('flash_session_example');
});


// reflash data - reflash session

Route::get('/reflash_data_first',function(Request $request){
$request->session()->flash('status','  هذه رسالة مؤقته لمدة طلبين   فقط !');
return redirect('/reflash_data_second');


});

Route::get('/reflash_data_second',function(Request $request){
$request->session()->reflash();

return redirect('/reflash_data_third');

});

Route::get('/reflash_data_third',function(Request $request){

return view('flash_session_example');

});

//keep reflsh

Route::get('/keep_data_first',function(Request $request){
$request->session()->flash('username',' atef');
$request->session()->flash('role',' admin');
$request->session()->flash('email',' admin@gmail.com');

return redirect('/keep_data_second');


});

Route::get('/keep_data_second',function(Request $request){
//الاحتفاظ ببعض الداتا
$request->session()->keep(['username', 'email']);

return redirect('/keep_data_third');

});

Route::get('/keep_data_third',function(Request $request){

return view('flash_session_example');

});

//session now
Route::get('/now_session_data',function(Request $request){
$request->session()->now('status',' تمت العملية فورا الان !');
return view('flash_session_example');
});

Route::get('forget_session', function (Request $request) {
 

    // Forget a single key...
 $request->session()->forget('name');
// Forget multiple keys...

$request->session()->forget(['name', 'role']);
$request->session()->flush();
    return " لقد تم حذف البيانات المحدده من  الجلسات   ";

});
Route::get('regenerate_session', function (Request $request) {
 
 $request->session()->regenerate();

  return " لقد تم اعاده تجديد رقم الجلسة او معرف الجلسة الحالية  ";

});
Route::get('invalidate_session', function (Request $request) {
 
$request->session()->invalidate(); 
  return " لقد تم اعاده تجديد رقم الجلسة وحذف كل البيانات التي بالجلسة  ";

});

Route::get('return_session_id',function(Request $request){
$sessionId=$request->session()->getId();
return " معرف الجلسة الحالي ".$sessionId;

});



Route::get('myfacade',[WelcomController::class,'myfacade']);
Route::fallback(function(){
    return " not found";
});
