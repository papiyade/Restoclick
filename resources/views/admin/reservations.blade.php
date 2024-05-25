<form class="book-form" action="{{ route('client.reservation.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

    <div class="columns">
        <fieldset class="name">
            <input type="text" placeholder="Name*" id="name" class="" name="client_name" tabindex="2" value="" aria-required="true" required="">
        </fieldset>
        <fieldset class="phone">
            <input type="text" placeholder="Phone*" id="phone_number" name="phone_number" class=""  tabindex="2" value="" aria-required="true" required="">
        </fieldset>
    </div>
    <div class="columns">
        <fieldset class="hour select">
            <input type="time" class="" id="time" name="time" tabindex="2" value="19:00" aria-required="true" required="">
        </fieldset>
        <fieldset class="select event-number">
            <input type="number" id="num_people" name="num_people" required>
        </fieldset>
        <fieldset class="time select">
            <input placeholder="Nombre de Personnes" type="date" class="" id="date" name="date" tabindex="2" value="2023-06-18" aria-required="true" required="">
        </fieldset>
    </div>
    <div class="bot">
        <button class="button-two-line w-full" type="submit">BOOK NOW</button>
    </div>
</form>
