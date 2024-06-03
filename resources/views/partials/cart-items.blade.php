            @foreach($plats as $plat)
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
        @endforeach
