<!-- ============================================================== -->
<!-- Notification -->
<!-- ============================================================== -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
        {{ App::getLocale() }} <i class="fa fa-angle-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right animated flipInY">
        @foreach($locales as $locale)
        <a href="{{ route('localization', ['locale' => $locale]) }}" class="dropdown-item">@lang("locales.{$locale}")</a>
        @endforeach
    </div>
</li>