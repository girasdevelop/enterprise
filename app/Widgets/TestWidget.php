<?php

namespace App\Widgets;

use Itstructure\Widgets\Contract\ContractWidget;

class TestWidget implements ContractWidget{

    public function execute(){

        return view('Widgets::test');

    }
}