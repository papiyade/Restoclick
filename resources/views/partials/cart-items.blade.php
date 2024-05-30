@foreach ($cart as $platId => $quantity)
    @php
        $plat = \App\Models\Plat::find($platId);
    @endphp
    <div class="col-md-6">
        <div class="shop-item wow fadeInUp">
            <div class="image">
                <img src="{{ asset('front/assets/images/box-item/shop-item-1.jpg') }}" alt="">
                <div class="box-icon">
                    <div class="wrap">
                        <a href="shop-detail.html"><i class="icon-shopping-bag"></i></a>
                    </div>
                </div>
            </div>
            <div class="content">
                <span class="button-wishlist"><span class="icon"></span></span>
                <div class="price">{{ $plat->price * $quantity }} Fcfa</div>
                <div class="name"><a href="#">{{ $plat->name }}</a></div>
                <div class="rating">
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                </div>
            </div>
        </div>
    </div>
@endforeach
