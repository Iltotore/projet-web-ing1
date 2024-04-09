@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    </head>
    <body>
        <div class="box">
            <div id="cart">
                <div id="title">Votre panier</div>
                <hr />
                @foreach(Auth::user()->getCartItems() as $item)
                    <div class="item" id="item#{{$item->id}}">
                        <div>
                            <img src="{{asset("product/" . $item->icon)}}" alt="icone"/>
                        </div>
                        <div class="info">
                            <label>{{$item->name}}</label>
                            <label class="amount">x{{$item->pivot->amount}}</label>
                            <label>{{$item->unit_price * $item->pivot->amount}} €</label>
                            <button @if($item->pivot->amount >= $item->amount) disabled @endif class="add" onclick="addItem({{$item->id}}, '{{csrf_token()}}')">+</button>
                            <button onclick="removeItem({{$item->id}}, '{{csrf_token()}}')">-</button>
                            <button onclick="deleteItem({{$item->id}}, '{{csrf_token()}}')">X</button>
                        </div>
                    </div>
                @endforeach
                <div id="actions">
                    <button onclick="clearItems('{{csrf_token()}}')">Vider le panier</button>
                </div>
            </div>
            <div id="summary">
                <div id="title">Total :</div>
                <button onclick="buyItems('{{csrf_token()}}')">Acheter</button>
            </div>
        </div>
    </body>
</html>
