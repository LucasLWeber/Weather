<?php

namespace App\Livewire;

use App\Services\WeatherService\WeatherService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Weather extends Component
{
    use Actions;

    public array $data = [];
    public string $value = 'Esteio';
    public string $actualTime;
    public array $forecast;
    public int $clicks = 0;
    public bool $request = false;


    public function getResponse():void
    {
        try{
            $this->request = true;
            $this->data = WeatherService::handle($this->value);
            $this->actualTime = explode(':', explode(' ', $this->data['location']['localtime'])[1])[0];
            $this->getForecastData();
        } catch (\Exception $e){
            $this->notification()->error(
                $title = 'Erro!',
                $description = 'Wops, error...'
            );
            $this->reset();
            $this->request = false;
        }

    }
    public function getForecastData(): array
    {
        foreach ($this->data['forecast']['forecastday'][0]['hour'] as $info) {
            $forecastInfo = [
                'icon' => $info['condition']['icon'],
                'temp_c' => $info['temp_c']
            ];
            $this->forecast[] = $forecastInfo;
        }

        return $this->forecast;
    }

    public function previousForecast(): void
    {
        if($this->actualTime + $this->clicks > 0){
            $this->clicks--;
        }
    }

    public function nextForecast(): void
    {
        if($this->actualTime + $this->clicks < (24 - 5)){
            $this->clicks++;
        }
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
