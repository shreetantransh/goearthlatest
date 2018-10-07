<ul class="nav navbar-nav text-right">
        @foreach ($_categories as $category)
            <li><a href="{{ $category->getUrl() }}">{{ $category->getName() }}</a></li>
        @endforeach

    </ul>
