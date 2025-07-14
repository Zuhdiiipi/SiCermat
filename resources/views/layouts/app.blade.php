<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body>
    <div class="wrapper">
        @include('partials.sidebar')
        <div class="main-panel">
            @include('partials.header')
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
            @include('partials.footer')
        </div>
        @include('partials.temp')
    </div>
    @include('partials.script')
</body>

</html>
