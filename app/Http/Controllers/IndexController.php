<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function index(Request $request,$name)
    {
        return new Response('hello '.$name??'');
    }
}
