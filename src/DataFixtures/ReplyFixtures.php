<?php

namespace App\DataFixtures;

use App\Entity\Reply;
use App\Entity\Ticket;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;
use PhpParser\Node\Expr\Cast\Array_;

class ReplyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $tic = Array();
        for ($j = 0; $j <20; $j++)  {
            $tic[$j] = new Ticket();
            $tic[$j]->setSubject($faker->words($nb = 2, $asText = true));
            $tic[$j]->setContent($faker->realText($maxNbChars = 200, $indexSize = 2));
            $tic[$j]->setStatus('Pending');
            $tic[$j]->setCategory($faker->word);

            $manager->persist($tic[$j]);
            $reply = Array();
        for ($i = 0; $i < 10; $i++) {
        $reply[$i] = new Reply();
        $reply[$i]->setContent($faker->realText($maxNbChars = 200, $indexSize = 2));
        $reply[$i]->setCreatedAt($faker->dateTime($max = 'now', $timezone = null));
        $reply[$i]->setTicket($tic[$j]);
        $manager->persist($reply[$i]);
        }
    }
        

        $manager->flush();
    }
}
