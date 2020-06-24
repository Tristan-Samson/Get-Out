<?php

namespace App\DataFixtures;

use App\Entity\Success;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SuccessFixtures extends Fixture
{
    const SUCCESS = [
        'Quests lvl 1' =>
        [
            'Description' => 'Accomplish 1 quest',
            'reward_points' => 1,
            'reward_exp' => 10,
        ],
        'Quests lvl 2' =>
        [
            'Description' => 'Accomplish 5 quests',
            'reward_points' => 5,
            'reward_exp' => 15,
        ],
        'Quests lvl 3' =>
        [
            'Description' => 'Accomplish 10 quests',
            'reward_points' => 10,
            'reward_exp' => 25,
        ],
        'Quests lvl 4' =>
        [
            'Description' => 'Accomplish 25 quests',
            'reward_points' => 25,
            'reward_exp' => 100,
        ],
        'Quests lvl 5' =>
        [
            'Description' => 'Accomplish 50 quests',
            'reward_points' => 50,
            'reward_exp' => 250,
        ],
        'Quests lvl 6' =>
        [
            'Description' => 'Accomplish 100 quests',
            'reward_points' => 100,
            'reward_exp' => 500,
        ],
        'Quests lvl 7' =>
        [
            'Description' => 'Accomplish 200 quests',
            'reward_points' => 100,
            'reward_exp' => 1000,
        ],
        
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SUCCESS as $name => $data)
        {
            $success = new Success;
            $success->setName($name);
            $success->setDescription($data['Description']);
            $success->setRewardPoints($data['reward_points']);
            $success->setRewardExp($data['reward_exp']);
            $manager->persist($success);
        }

        $manager->flush();
    }
}