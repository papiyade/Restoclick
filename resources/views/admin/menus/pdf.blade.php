<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Menu</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid #555;
            padding-bottom: 20px;
        }

        .header-left {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .header-left img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .header-right {
            text-align: right;
            margin-bottom: 8px;
        }

        h1, h2{
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 28px;
            border-bottom: 2px solid #555;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 22px;
            margin-top: 30px;
            margin-bottom: 10px;
            color: #444;
            text-transform: uppercase;
        }

        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Menu layout */
        .category-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #eee;
            border-radius: 5px;
            text-align: center;
        }

        .plat-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 8px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .plat-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .plat-price {
            font-size: 16px;
            font-weight: bold;
            color: #444;
        }

        .tiret {
            color: #333;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 5px 0;
        }

        /* Footer styles */
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

<!-- Header Section with Logo and Contact Info -->
<div class="header d-flex justify-content-between">
    <div class="header-left">
        @if ($menu->restaurant->logo)
            <img src="{{ public_path('storage/' . $menu->restaurant->logo) }}" alt="Logo" class="img-thumbnail mt-2">
        @endif

        <h3>{{ $menu->restaurant->name }}</h3>
        <p>{{ $menu->restaurant->address }}</p>
    </div>
    <div class="header-right">
        <p><strong>Téléphone:</strong> {{ $menu->restaurant->phone_number}}</p>
        <p><strong>Email:</strong> {{ $menu->restaurant->email }}</p>
    </div>
</div>

<!-- Menu Title and Description -->
<h1>{{ $menu->name }}</h1>
<p style="text-align: center">{{ $menu->description }}</p>

<!-- Category and Dish Listing -->
@foreach ($categories as $category)
    @if ($menu->plats->where('category_id', $category->id)->count() > 0)
        <h2 class="category-title">{{ $category->name }}</h2>
        <ul>
            @foreach ($menu->plats->where('category_id', $category->id) as $plat)
                <li class="plat-item">
                    <span class="plat-name">{{ $plat->name }}</span>
                    <span class="tiret">-----------------------------------------------------------------------------</span>
                    <span class="plat-price">{{ $plat->price }} Fcfa</span>
                </li>
            @endforeach
        </ul>
    @endif
@endforeach

<!-- Footer -->
<footer>
    Merci d'avoir consulté notre menu ! Nous espérons vous servir bientôt.
</footer>

</body>
</html>
