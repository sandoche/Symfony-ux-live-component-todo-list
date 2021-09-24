<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;


#[AsLiveComponent('random_number')]
class RandomNumberComponent
{

  use DefaultActionTrait;

  #[LiveProp(writable: true)]
  public int $min = 0;

  #[LiveProp(writable: true)]
  public int $max = 1000;

  public function getRandomNumber(): string
  {
      return rand($this->min, $this->max);
  }

}
