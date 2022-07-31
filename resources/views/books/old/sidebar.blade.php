<div class="container">
    {{-- navigator vertical list of user options --}}
    <div class="vertical-navigation">
        <ul>
            <li>
                <a>
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title"></span>
                </a>
            </li>
            <li>
                <a >
                    <span class="icon">
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Blank</span>
                </a>
            </li>

            <li>
                <a >
                    <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </span>
                    <span class="title">Excel</span>
                </a>
            </li>

            <li>
                <a >
                    <span class="icon">
                        <ion-icon name="albums-outline"></ion-icon>
                    </span>
                    <span class="title">Categories</span>
                </a>
            </li>

            <li>
                <a href="/epub">
                    <span class="icon">
                        <ion-icon name="book-outline"></ion-icon>
                    </span>
                    <span class="title">Epub</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                    </span>
                    <span class="title">About</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Setting</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="grid-outline"></ion-icon>
            </div>
            <form action="{{ route('search.book') }}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="search">
                    <label>
                        <input name="value" type="text" placeholder="Search here">
                        <ion-icon name="search-circle-outline"></ion-icon>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
