<?php

/**
 * 
 */
class PageController
{
    public function home()
    {
        $users = App::get('database')->selectAll('users');
        return view('index', ['users'=>$users]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
       return view('contact');
    }

    public function insert()
    {
        App::get('database')->insert('users', [
            'name' => $_POST['name']
        ]);
        header('Location: /');
    }
}