<?php

namespace App\Livewire;

use App\Services\WeatherService\WeatherService;
use Livewire\Component;

class Weather extends Component
{

    public array $data = [];
    public string $value = 'Novo Hamburgo';
    public string $actualTime;

    public function getResponse():void
    {
        $this->data = WeatherService::handle($this->value);
        $this->actualTime = explode(':', explode(' ', $this->data['location']['localtime'])[1])[0];
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
