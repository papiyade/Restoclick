@foreach ($cartItems as $item)
    <div class="cart-item">
        <span>{{ $item->name }}</span>
        <span>{{ $item->quantity }} x {{ $item->price }}</span>
    </div>
@endforeach
