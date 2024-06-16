            {{-- @foreach($plats as $plat)
            <div class="cart-item">
                <div class="image">
                    <img src="{{ asset('front/assets/images/box-item/shop-item-1.jpg') }}" alt="">                </div>
                <div class="content">
                    <div class="price">{{ $plat->price }} Fcfa</div>
                    <div class="name">
                        <a href="/shop-detail/{{ $plat->id }}">{{ $plat->name }}</a>
                    </div>
                </div>
                <div class="close-button" @click="removeFromCart({{ $plat->id }})">
                    <i class="icon-close"></i>
                </div>
            </div>
        @endforeach --}}


        @foreach ($cartItems as $cartItem)
    <div class="cart-item mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>{{ $cartItem->plat->name }}</div>
            <div>
                <button class="btn btn-sm btn-outline-secondary minus-btn" data-plat-id="{{ $cartItem->plat->id }}">-</button>
                <span class="mx-2 quantity">{{ $cartItem->quantity }}</span>
                <button class="btn btn-sm btn-outline-secondary plus-btn" data-plat-id="{{ $cartItem->plat->id }}">+</button>
            </div>
            <div>{{ $cartItem->plat->price }} Fcfa</div>
        </div>
    </div>
@endforeach
