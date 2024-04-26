<div x-data="{ search: false }" class="flex flex-col max-w-5xl items-center min-h-screen">
    <header class="flex flex-row items-center justify-between h-[100px] w-[1000px] bg-slate-100 px-10">
        <h1 class="font-bold text-3xl">Weather</h1>
        <input
            type="text"
            placeholder="Ex.: London, Dublin, Dubai"
            class="w-[500px] h-[45px] rounded-lg focus:border-slate-200"
            wire:model="value"
        />

       <x-button
            type="submit"
            icon="search"
            wire:click="getResponse"
            x-on:click="search = true"
       >
       </x-button>
    </header>

    <div class="flex flex-col items-center justify-center w-[1000px] mt-[60px]">
        <template x-transition  x-if="!search">
            <h2>No requests yet!</h2>
        </template>
        <div x-transition class="flex flex-col items-center">
            <h2 class="font-bold text-3xl mb-2" x-text="$wire.data.location.name"></h2>
            <img class="font-bold text-3xl" :src="$wire.data.current.condition.icon">
            <p class="font-bold text-base" x-text="`${$wire.data.current.temp_c} &deg;C`"></p>
            <span class="font-normal text-base mb-2" x-text="$wire.data.current.condition.text"></span>
        </div>
    </div>


    <template x-if="search">
        <div class="flex flex-row justify-between bg-slate-100 h-[100px] w-[1000px] mt-4 p-1">
            @for($i = $actualTime; $i < $actualTime + 6; $i++)
                @if($i === $actualTime)
                    <x-temp-icon
                        date="'now'"
                        url="$wire.data.current.condition.icon"
                        temp="$wire.data.current.temp_c"
                    />
                @else
                    <x-temp-icon
                        date="{{ $i }} + ':00'"
                        url="$wire.data.forecast.forecastday.0.hour.{{$i}}.condition.icon"
                        temp="$wire.data.forecast.forecastday.0.hour.{{$i}}.temp_c"
                    />
                @endif
            @endfor
        </div>
    </template>

</div>
