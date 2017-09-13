<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $update;
    protected $title;
    protected $description;
    protected $keywords;

    public function __construct() {
        $this->update = NULL;
        $this->title = NULL;
        $this->description = NULL;
        $this->keywords = NULL;
    }
}
