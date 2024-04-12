@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html>
    <body>
        <script>
            window.onload = () => {
                loadCart('{{csrf_token()}}')
                loadNavbarLogic()
            }
        </script>
        <div class="box">
            <div id="cart">
                <div id="title">Votre panier</div>
                <div id="items"></div>
                <div id="actions">
                    <button onclick="clearItems('{{csrf_token()}}')">Vider le panier</button>
                </div>
            </div>
            <div id="summary">
                <div id="total_price">Total :vofndvd</div>
                <button onclick="buyItems('{{csrf_token()}}')">Acheter</button>
            </div>
        </div>
    </body>
</html>
