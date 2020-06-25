<?php

namespace App\DataFixtures;

use App\Entity\Quest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class QuestFixtures extends Fixture
{
    const QUESTS = [
        'Sport lvl 1' =>
        [
            'Description' => 'Do 15 minutes of sport today',
            'type' => 1,
            'exp' => 10,
        ],
        'Sport lvl 2' =>
        [
            'Description' => 'Do 30 minutes of sport today',
            'type' => 1,
            'exp' => 15,
        ],
        'Sport lvl 3' =>
        [
            'Description' => 'Do 1 hour of sport today',
            'type' => 1,
            'exp' => 25,
        ],
        'Sport lvl 3' =>
        [
            'Description' => 'Do 1 hour of sport today',
            'type' => 1,
            'exp' => 25,
        ],
        'Activity' =>
        [
            'Description' => 'Take a day to do an activity of your choice',
            'type' => 2,
            'exp' => 100,
        ],
        'Be creative' =>
        [
            'Description' => 'Take an hour to create anything you want',
            'type' => 2,
            'exp' => 50,
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::QUESTS as $name => $data)
        {
            $quest = new Quest;
            $quest->setName($name);
            $quest->setDescription($data['Description']);
            $quest->setType($data['type']);
            $quest->setExp($data['exp']);
            $manager->persist($quest);
        }

        $manager->flush();
    }
}
