<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                @foreach($pages as $page)
                @if($loop->last)
                <li class="active">{{ $page }}</li>
                @else
                <li><a href="#">{{ $page }}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>