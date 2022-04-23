<link rel="stylesheet" type="text/css" href="css/new.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

{{--<div class="ovalTwo">--}}
{{--    <div class="hamburger-menu">--}}
{{--        <input id="menu__toggle" type="checkbox" />--}}
{{--        <label class="menu__btn" for="menu__toggle">--}}
{{--            <span></span>--}}
{{--        </label>--}}
{{--        <ul class="menu__box">--}}
{{--            <li><a class="menu__item" href="{{route('login')}}">Аккаунт пользователя</a></li>--}}
{{--            <li><a class="menu__item" href="#">Добавить должника</a></li>--}}
{{--            <li><a class="menu__item" href="#">Список должников</a></li>--}}
{{--            <li><a class="menu__item" href="#">Список погашенных долгов</a></li>--}}
{{--            <li><a class="menu__item" href="#">Решения судебных исполнителей</a></li>--}}
{{--            <li><a class="menu__item" href="#">Экспорт</a></li>--}}
{{--            <li><a class="menu__item" href="#">Поиск должников</a></li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="mainContent">
    <div class="row pt-4 pb-4">
        <div class="offset-10">
            @if (!Auth::user())
            <a href="{{route('login')}}" style="color:white">Вход в аккаунт</a>
            @else
                <a href="{{route('login')}}" style="color:white">Админ панель</a>
            @endif
        </div>
    </div>
    <div class="contentWrapper">
        <p class="contentWrapper-txt">
            АВТОМАТИЗИРОВАННАЯ ИНФОРМАЦИОННАЯ СИСТЕМА
            ОРГАНОВ ИСПОЛНИТЕЛЬНОГО ПРОИЗВОДСТВА
        </p>
        <ul class="contentWrapper-list">
            <li class="contentWrapper-item">
                <div class="oval">
                    2220
                </div>
                <p>
                    Частных судебных исполнителей
                </p>
            </li>
            <li class="contentWrapper-item">
                <div class="oval">
                    260
                </div>
                <p>
                    Государственных судебных исполнителей
                </p>
            </li>
        </ul>
    </div>
    <div class="black-info">
        <div class="black-infoWrapper">
            <div class="black-info-leftSide">
                <p class="black-info-leftSide-title">3 917 766</p>
                <p class="black-info-leftSide-txt">исполнительных производств на исполнении на общую сумму</p>
                <p class="black-info-leftSide-bottomTxt">10 299 753 184 332 тг</p>
            </div>
            <div class="black-info-rightSide">
                <p class="black-info-leftSide-title">9 712 469</p>
                <p class="black-info-leftSide-txt">оконченных исполнительных производств на сумму</p>
                <p class="black-info-leftSide-bottomTxt">4 120 494 076 887 тг</p>
            </div>
        </div>
    </div>
</div>
