<?php


namespace App\Controllers;


use App\Models\Book;
use Laminas\Diactoros\Response\TextResponse;
use League\Route\Http\Exception\NotFoundException;

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

        return redirect("/list");
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
    public function show($req, $args)
    {
        $book=((Book::query()->findBy(["id"=> $args["id"]]))[0]);
        if($book!=null){
            return view('show.twig', [
                'book'=>$book
            ]);
        }
        throw new NotFoundException();
    }
    public function delete()
    {
        $id=request("id");
        $book=((Book::query()->findBy(["id"=> $id]))[0]);
        $book->remove();
        return redirect("/list");
    }
    function edit($req, $args){
        $book=((Book::query()->findBy(["id"=> $args["id"]]))[0]);
        if($book!=null){
            return view('create.twig',[
                'book'=>$book
            ]);
        }
        throw new NotFoundException();
    }
    function update(){
        $id=request('id');
        $name=request("name");
        $book=((Book::query()->findBy(["id"=> $id]))[0]);
        $book->setName($name);
        $book->save();

        return redirect("/list/{$id}");
    }
}