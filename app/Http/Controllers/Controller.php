<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slugify($string, $table)
    {
        $slug = Str::slug(Str::limit($string, 30), '-');

        $isDuplicate = DB::table($table)->where('slug', $slug)->count();

        while ($isDuplicate > 0)
        {
            $slug = Str::slug($string, '-') . '-' . Str::random(3) . '-' . Str::random(3);
            $isDuplicate = DB::table($table)->where('slug', $slug)->count();
        }

        return Str::lower($slug);
    }
}
