<div class="rate {{ $parentName . '__rate' }}">
    @php
        $newRate = $rate;
        $bufor = $newRate;
    @endphp

    @for ($i = 0; $i < 5; $i++)
        <span role="img" class="rate rate__star
        rate__icons far fa-star" aria-label="Gwiadka ocena"></span>
    @endfor
</div>
