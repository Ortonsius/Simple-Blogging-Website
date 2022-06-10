<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $req) {
    $c = $req->query("c");
    $q = $req->query("q");

    $OUT = [
        "trend" => DB::select("select * from posts order by view asc limit 3")
    ];

    if($c == NULL && $q == NULL){
        $OUT += ["data" => DB::table("posts")->get()->toArray()];
    }else if($c == NULL && $q != NULL){
        $OUT += ["data" => DB::table("posts")->where("title","LIKE","%".$q."%")->get()->toArray()];
    }else if($c != NULL && $q == NULL){
        $OUT += ["data" => DB::table("posts")->where("category","=",$c)->get()->toArray()];
    }else if($c != NULL && $q != NULL){
        $OUT += ["data" => DB::table("posts")->where("category","=",$c)->andWhere("title","like","%".$q."%")->get()->toArray()];
    }

    return view('home',$OUT);
});

Route::get('/login', function (Request $req) {
    return view('login');
});

Route::post('/login', function (Request $req) {
    $c = $req->input("name");
    $q = $req->input("pwd");

    if(count(DB::select("SELECT * FROM accounts WHERE name = '$c' AND password = '$q'")) == 1){
        session_start();
        $_SESSION["name"] = $c;
        echo "<script>location.href = '/';</script>";
        return;
    }

    echo "<script>alert('invalid password/username')</script>";
    return view('login');
});

Route::get('/logout', function (Request $req) {
    session_start();
    $_SESSION = [];
    session_destroy();
    echo "<script>location.href = '/';</script>";
    return;
});

Route::get('/post/{pid}', function ($pid){
    $OUT = ["trend" => DB::select("select * from posts order by view asc limit 3")];
    $post = DB::table("posts")->where("id",$pid)->get();
    if(count($post) == 1){
        $p = $post[0];
        $inc = intval($p->view) + 1;
        $OUT += ["title" => $p->title];
        $OUT += ["content" => $p->content];
        $OUT += ["img" => $p->image];
        $OUT += ["date" => $p->date];
        DB::select("update posts set view = $inc where id = '$pid'");
    }else{
        abort(404);
        return;
    }
    return view('detail',$OUT);
});