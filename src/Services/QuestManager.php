<?php

namespace App\Services;

use App\Entity\Validation;

class QuestManager
{

    public function resetDailyQuest(Validation $validation)
    {
        $lastClear = $validation->getValidationDate();
        $currentDate = new \DateTime("now");
        $interval = $currentDate->diff($lastClear, true);
        if (($interval->days > 0) && ($validation->getIsValid())) 
        {
            $validation->setIsValid(false);
        }
    }
}