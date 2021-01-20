<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FooController
{
    public function index(Request $request)
    {
        return new Response('hello');
    }
}
