<?php
namespace app\home\controller;

class Error extends Controller
{
    public function _empty(Request $request)
    {
        $this->redirect('/');
    }
}