<?php


namespace App\Controllers;


use App\Models\Book;
use Laminas\Diactoros\Response\TextResponse;

class SiteController
{
    function index(){
        $books=Book::query()
            ->findAll();

        return view('home.twig',[
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
}