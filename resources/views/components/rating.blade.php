<div class="rate {{ $parentName . '__rate' }}">
    @php
        $newRate = $rate > 5 ? 5 : $rate;
    @endphp

    @for ($i = 0; $i < 5; $i++)
        @if ($newRate >= 1) <span role="img" class="rate rate__star
        rate__icons fas fa-star" aria-label="Gwiadka ocena"></span>
    @elseif($newRate < 1 && $newRate > 0)
        <span role="img" class="rate rate__star
        rate__icons fas fa-star-half-alt" aria-label="Gwiadka ocena"></span>
    @else
        <span role="img" class="rate rate__star
        rate__icons far fa-star" aria-label="Gwiadka ocena"></span> @endif

        @php
            $newRate -= 1;
        @endphp
    @endfor

    <span class="rate__detalis">{{ $rate }}</span>
    @isset($ratesAmount)
        <span class="rate__detalis">({{ $ratesAmount }})</span>
    @endisset
</div>
