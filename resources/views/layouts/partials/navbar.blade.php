<nav class="navbar navbar-expand-lg navbar-light bg-light arteeNav fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing-page') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navigationAlign" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        PROJECTS
                    </a>
                    <div class="dropdown-menu">
                        @if($projectYears != null)
                            @foreach ($projectYears as $year)
                                <a class="dropdown-item" href="{{ route('projects-filtered', $year->year) }}">{{ $year->year }}</a>
                            @endforeach
                        @else
                            <a class="dropdown-item" href="#">No projects yet</a>
                        @endif
                    </div>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about-us') }}">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact-us') }}">CONTACT</a>
                </li>

            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="">
                    <a target="_blank" class="nav-link" href="{{ $settings->facebook ?? '#' }}">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="">
                    <a target="_blank" class="nav-link" href="{{ $settings->instagram ?? '#' }}">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
                <li class="">
                    <a target="_blank" class="nav-link" href="{{ $settings->youtube ?? '#' }}">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>