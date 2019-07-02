<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-07-01
 * Time: 17:31
 */
namespace App\Service;

class Slugify
{
    public function generate(string $input) : string
        {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
        $slug = mb_strtolower(preg_replace( '/[^A-Za-z0-9\-\s]/', '', $slug ));
        $slug = str_replace(' ','-',trim($slug));
        $slug = preg_replace('/\s\s+/', '-', $slug);

        return $slug;
        }
}
