<div class="posts">
    @foreach($data as $i)
    <div class="post" onclick="location.href = '/post/{{ $i->id }}';">
        <div class="imgbox">
            <img src="{{ $i->image }}">
        </div>
        <div class="title">
            {{ $i->title }}
        </div>
    </div>
    @endforeach
</div>