<div class="header" style="height: {{ $height ?? "" }}">
    <img src="{{ asset($img ? Storage::url($img) : 'img/header.webp') }}" alt="">
    <div class="textbox">
        <h2>{{ $title ?? "GLR gaat op reis!" }}</h2>
        <h4>{{ $undertitle ?? "Schrijf je nu in voor de reis die jou het leukst lijkt!" }}</h4>
    </div>
</div>
