<div class="flex flex-col max-w-5xl items-center min-h-screen">
    <header class="flex flex-row items-center justify-between h-[100px] w-[1000px] bg-slate-100 px-10">
        <h1 class="font-bold text-3xl">Weather</h1>
        <input
            type="text"
            placeholder="Ex.: London, Dublin, Dubai"
            class="w-[500px] h-[45px] rounded-lg focus:border-slate-200"
            wire:model="value"
        />
       <x-button
            type="button"
            icon="search"
            wire:click="getResponse"
       >
       </x-button>
    </header>

    <div class="flex flex-col items-center justify-center w-[1000px] mt-[60px]">
        @if(!$request)
            <h2>No requests yet!</h2>
        @else
            <div class="flex flex-col items-center">
                <h2 class="font-bold text-3xl">{{ $data['location']['name'] }}</h2>
                <img class="font-bold text-3xl" src="{{ $data['current']['condition']['icon'] }}">
                <p class="font-bold text-base mb-2">{{ $data['current']['temp_c'] }} &deg;C</p>
                <p class="font-semibold text-base mb-2">{{ explode(' ', $data['location']['localtime'])[1] }}</p>
                <span class="font-light text-base mb-2">Wind: {{ $data['current']['wind_kph'] }} Km/h</span>
                <span class="font-light text-base mb-2">Humidity: {{ $data['current']['humidity'] }} &percnt;</span>
            </div>
        @endif
    </div>


    @if($request)
        <div class="flex flex-row justify-between bg-slate-100 h-[100px] w-[1000px] mt-4 p-1">
            @for($i = $actualTime; $i < $actualTime + 6; $i++)
                    @if(isset($forecast[$i]))
                        <x-temp-icon
                            date="{{ $i + $clicks }} + ':00'"
                            url="{{ $forecast[$i+$clicks]['icon'] }}"
                            temp="{{ $forecast[$i+$clicks]['temp_c'] }}"
                        />
                    @endif
            @endfor
        </div>
    @endif

    @if($request)
        <div class="flex flex-row justify-between w-[1000px] mt-4 py-1 px-12">
            <x-button
                type="button"
                icon="arrow-left"
                wire:click="previousForecast"
            />
            <x-button
                type="button"
                icon="arrow-right"
                wire:click="nextForecast"
            />
        </div>
    @endif

</div>
