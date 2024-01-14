<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        $tests = Test::all();
        $first = Test::value('newstitle');
        return view('weakness', compact('first'));


    }
    public function createTestData()
    {
        Test::create([
            'img_path' => 'your_image_path',
            'newstitle' => 'your_title',
            'content' => 'your_content',
        ]);

        return '資料新增成功';
    }
}
