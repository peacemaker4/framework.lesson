<?php


namespace App\Controllers;


use App\Models\Book;
use Laminas\Diactoros\Response\TextResponse;

class SiteController
{
    function index(){
        $books=Book::query()
            ->findAll();
        return view('list.twig',[
            'books'=>$books
        ]);
    }
    function create(){
        return view('create.twig');
    }
    function store(){
        $name=request('name');
        $book=new Book();
        $book->setName($name);
        $book->save();

        return redirect("/");
    }
    function home(){
        $name=$_SESSION['name']??null;
        return view('home.twig',[
            'name'=>$name
        ]);
    }
    function username(){
        $name=request('name');
        $_SESSION['name']=$name;
        return redirect("/");
    }
}