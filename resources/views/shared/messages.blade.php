@if ($message = Session::get('warning'))
    <div class="messages app__messages">
        <div class="messages__icon-container messages__icon-container--warning">
            <span class="icons icons messages__icons fas fas fa-exclamation-circle" aria-hidden="true"></span>
        </div>

        <div class="messages__body">

            <h4 class="titles messages__titles">Ostrzeżenie</h4>

            <p class="messages__text">
                {{ $message }}
            </p>

        </div>

        <button class="buttons buttons--bg-no  buttons--delete-text  messages__buttons" data-dismiss="alert">
            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
            </span>
        </button>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="messages app__messages">
        <div class="messages__icon-container messages__icon-container--success">
            <span class="icons icons messages__icons fas fas fa-check-circle" aria-hidden="true"></span>
        </div>

        <div class="messages__body">

            <h4 class="titles messages__titles">Sukces</h4>

            <p class="messages__text">
                {{ $message }}
            </p>

        </div>

        <button class="buttons buttons--bg-no  buttons--delete-text  messages__buttons" data-dismiss="alert">
            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
            </span>
        </button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="messages app__messages">
        <div class="messages__icon-container messages__icon-container--info">
            <span class="icons icons messages__icons fas fas fa-info-circle" aria-hidden="true"></span>
        </div>

        <div class="messages__body">

            <h4 class="titles messages__titles">Info</h4>

            <p class="messages__text">
                {{ $message }}
            </p>

        </div>

        <button class="buttons buttons--bg-no buttons--delete-text messages__buttons" data-dismiss="alert">
            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
            </span>
        </button>
    </div>
@endif

@if ($message = Session::get('danger'))
    <div class="messages app__messages">
        <div class="messages__icon-container messages__icon-container--danger">
            <span class="icons icons messages__icons fas fas fa-exclamation-triangle" aria-hidden="true"></span>
        </div>

        <div class="messages__body">

            <h4 class="titles messages__titles">Błąd</h4>

            <p class="messages__text">
                {{ $message }}
            </p>

        </div>

        <button class="buttons buttons--bg-no buttons--delete-text messages__buttons" data-dismiss="alert">
            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
            </span>
        </button>
    </div>
@endif
