<div class="trend">
    @foreach($trend as $i)
    <div class="box" onclick="location.href = '/post/{{ $i->id }}';">
        <div class="left">
            <img src="{{ $i->image }}">
        </div>
        <div class="right">
            <p>{{ $i->title }}</p>
        </div>
    </div>
    @endforeach
</div>