<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-24
 * Time: 16:22
 */

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++) {
        $article = new Article();
        $article->setTitle(mb_strtolower($faker->sentence()));
        $article->setContent(mb_strtolower($faker->text()));
        $manager->persist($article);
        $article->setCategory($this->getReference('category_' . rand(0, 4)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
