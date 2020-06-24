<?php

namespace App\Services;

use App\Entity\Validation;

class QuestManager
{

    public function resetDailyQuest(Validation $validation)
    {
        $lastClear = $validation->getValidationDate();
        $currentDate = new \DateTime("now");

        $interval = $currentDate->diff($lastclear, true);
        if (($interval->days > 0) && ($validation->getIsValid())) 
        {
            $validation->setIsValid(false);
        }
    }

    public function questValidation(Validation $validation)
    {
        $currentDate = new \DateTime("now");
        $validation->setValidationDate($currentDate);
        $validation->setIsValid(true);
        $quest = $validation->getQuests();
        $user = $validation->getuserId();

        $avatar = $user->getAvatar();
        $avatar->setTotalExp($avatar->getTotalExp() + $quest->getExp());
        $rewardStuff = $quest->getEquipement();
        if (isset($rewardStuff))
        {
            $avatar->addEquipement($rewardStuff);
        }
    }
}