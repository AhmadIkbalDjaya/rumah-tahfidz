<?php

namespace App\Traits\Livewire;

trait WithToast
{
  public function toast($message, $type = "info")
  {
    $encoded_data = json_encode([
      'toast' => [
        'message' => $message,
        'type' => $type,
        'timeout' => 3000,
      ]
    ]);
    $this->js('toast('. $encoded_data .')');
  }
}