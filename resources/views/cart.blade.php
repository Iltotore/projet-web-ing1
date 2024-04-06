@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<body>
<div id="items">
    @foreach(Auth::user()->getCartItems() as $item)
        <div class="item" id="item#{{$item->id}}">
            <div class="info">
                <img src="{{asset("product/" . $item->icon)}}" alt="icone"/>
                <label>{{$item->name}}</label>
                <label class="amount">x{{$item->pivot->amount}}</label>
            </div>
            <div class="actions">
                <button @if($item->pivot->amount >= $item->amount) disabled @endif class="add" onclick="addItem({{$item->id}}, '{{csrf_token()}}')">+</button>
                <button class="sub" onclick="removeItem({{$item->id}}, '{{csrf_token()}}')">-</button>
                <button onclick="deleteItem({{$item->id}}, '{{csrf_token()}}')">X</button>
            </div>
        </div>
    @endforeach
</div>
<div id="actions">
    <button onclick="buyItems('{{csrf_token()}}')">Acheter</button>
    <button onclick="clearItems('{{csrf_token()}}')">Vider le panier</button>
</div>
</body>
