<div class="col-sm-6 text-light">
    <p class="m-0 text-right">
        {{-- Follow Me:
        <i class="fab fa-twitter px-3"></i>
        <i class="fab fa-youtube-square px-3"></i>
        <i class="fab fa-google-plus-g px-3"></i>
        <i class="fab fa-github px-3"></i>
        <i class="fab fa-facebook-f px-3"></i> --}}
        {{-- Dynamic footer menus --}}

            @foreach($items as $menu_item)
                @if ($menu_item->title == 'Follow Us:')
                    <span class="text-light">{{ $menu_item->title }}</span>
                @endif
                <a class="social text-light" href="{{ $menu_item->link() }}">
                    <i class="fab {{ $menu_item->title }} px-3"></i>
                </a>

            @endforeach

    </p>
</div>
