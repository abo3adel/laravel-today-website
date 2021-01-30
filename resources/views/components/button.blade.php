@props(['icon', 'bg' => '', 'border' => 'px-3 py-2', 'clear' => false, 'rounded' => true, 'spin' => false])

@php
    $bgClasses = $clear ? " text-$bg-500 bg-transparent hover:text-white border-$bg-500 " : ' bg-'.$bg.'-500 text-white border-transparent ';

    $rounded = $rounded ? 'rounded-md' : '';

    $loaderId = "loader" . random_int(1, 565654);
@endphp

    <button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'inline-flex items-center hover:bg-'.$bg.'-700 active:bg-'.$bg.'-800' .$bgClasses. $border.' border '.$rounded.' font-semibold text-xs uppercase tracking-widest focus:outline-none focus:border-'.$bg.'-800 focus:shadow-outline-'.$bg.' disabled:opacity-25 transition ease-in-out duration-500',
    ]) }} @if($spin) x-data x-on:click="$refs['{{$loaderId}}'].classList.remove('hidden');$refs['{{$loaderId}}'].classList.add('fas', 'fa-spin')" @endif>
        @isset($icon)
            <i id='loader' class='{{ $icon }} px-1'></i>
            @if ($spin)
                <i x-ref='{{$loaderId}}' class='hidden px-1 fa-cog'></i>
            @endif
        @endisset
        {{ $slot }}
    </button>
