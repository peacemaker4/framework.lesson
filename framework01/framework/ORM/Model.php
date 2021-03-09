<?php


namespace Framework\ORM;


use Doctrine\ORM\EntityManager;
use Framework\Providers\DatabaseProvider;

class Model
{
    static function query(){
        $manager=app(DatabaseProvider::class)->manager();
        return $manager->getRepository(static::class);
    }


    function save(){
        /** @var EntityManager $manager */
        $manager=app(DatabaseProvider::class)->manager();

        $manager->persist($this);
        $manager->flush();
    }
}