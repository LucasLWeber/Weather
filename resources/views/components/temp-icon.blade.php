<div class="flex flex-col items-center justify-center space-y-0.5">
    <h3 class="font-bold text-base text-black uppercase" x-text="{{ $date }}"></h3>
    <img class="h-12 w-12" src="{{ $url }}">
    <span class="font-normal text-base" x-text="{{ $temp }} + ' &deg;C'"></span>
</div>
