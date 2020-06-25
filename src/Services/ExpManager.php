<?php

namespace App\Services;


class ExpManager
{
    const LVL = [
        0 => 0,
        1 => 100,
        2 => 250,
        3 => 500,
        4 => 800,
        5 => 1250,
        6 => 2000,
        7 => 3000,
        8 => 4500,
        9 => 7000,
        10 => 10000
    ];

    //Prend l'expérience du personnage en entrée et renvoie son niveau
    public function getLevel(int $exp):int 
    {
        $playerlvl = 0;
        foreach(self::LVL as $lvl => $requiredexp)
        {
            if ($exp > $requiredexp)
            {
                $playerlvl = $lvl;
            }
        }
        return $playerlvl;
    }
}