<button onclick="changeLocale('{{ route(Route::currentRouteName(),['locale'=>'en','id'=>request()->id]) }}')" @if (App::getLocale() == 'en') class="active" @endif>English</button>
<button onclick="changeLocale('{{ route(Route::currentRouteName(),['locale'=>'nl','id'=>request()->id]) }}')" @if (App::getLocale() == 'nl') class="active" @endif>Nederlands</button>
