<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-24
 * Time: 10:03
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

const CATEGORIES = [
    'PHP',
    'JS',
    'Ruby',
    'SQL',
    'HTML',
    'CSS'
];

    public function load(ObjectManager $objectManager)
    {
        foreach(self::CATEGORIES as $key =>$categoryName)
        {
            $category = new Category();
            $category->setName($categoryName);
            $objectManager->persist($category);
            $this->addReference('category_' . $key, $category);
        }
        $objectManager->flush();
    }
}