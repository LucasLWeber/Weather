<?php

namespace App\Livewire;

use App\Services\WeatherService\WeatherService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Weather extends Component
{
    use Actions;

    public array $data = [];
    public string $value = '';
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
            $this->clicks = 0;
        } catch (\Exception $e){
            $this->value = '';
            $this->request = false;
            abort(404);
        }

    }
    public function getForecastData(): array
    {
        $this->forecast = [];

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
        if(count($this->forecast) - $this->actualTime > 6){
            $forecastsRenderized = 6;
        } else {
            $forecastsRenderized = count($this->forecast) - $this->actualTime;
        }

        if($this->actualTime + $this->clicks + $forecastsRenderized < count($this->forecast)){
            $this->clicks++;
        }
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
