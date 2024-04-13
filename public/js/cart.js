let items;

function getItem(id) {
    return items.find(i => i.id === id)
}

async function loadCart(token) {
    result = await sendJSON("/cart/get", {_token: token}, "GET")
    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        const container = document.getElementById("items")
        for (let i = 0; i < jsonResponse.length; i++) {
            const item = jsonResponse[i]
            const itemCard =
                `
                    <div class="item" id="item#${item.id}">
                        <div>
                            <img src="/product/${item.icon}" alt="icone"/>
                        </div>
                        <div class="info">
                            <label>${item.name}</label>
                            <label class="amount">x${item.pivot.amount}</label>
                            <label class="price">${item.unit_price * item.pivot.amount} €</label>
                            <button ${item.amount <= item.pivot.amount ? "disabled" : ""} class="add" onclick="addItem(${item.id}, '${token}')">+</button>
                            <button onclick="removeItem(${item.id}, '${token}')">-</button>
                            <button onclick="deleteItem(${item.id}, '${token}')">X</button>
                        </div>
                    </div>
                `
            container.innerHTML += itemCard
        }
        items = jsonResponse
        updatePrice()
    }
}

async function addItem(id, token) {
    const result = await sendJSON("/cart/add", {
        product: id,
        amount: 1,
        _token: token
    })

    const item = getItem(id)
    const itemDiv = document.getElementById("item#" + id);
    const itemAmount = itemDiv.getElementsByClassName("amount")[0]
    const itemAdd = itemDiv.getElementsByClassName("add")[0]

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = false
                item.pivot.amount = jsonResponse.amount
                break

            case "full":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = true
                item.pivot.amount = jsonResponse.amount
                break
        }
        updatePrice()
    }
}

async function removeItem(id, token) {
    const result = await sendJSON("/cart/remove", {
        product: id,
        amount: 1,
        _token: token
    })

    const item = getItem(id)
    const itemDiv = document.getElementById("item#" + id);
    const itemAmount = itemDiv.getElementsByClassName("amount")[0]
    const itemAdd = itemDiv.getElementsByClassName("add")[0]

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = false
                item.pivot.amount = jsonResponse.amount
                break

            case "full":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = true
                item.pivot.amount = jsonResponse.amount
                break

            case "doesNotExist":
            case "delete":
                itemDiv.remove()
                item.pivot.amount = 0
        }
        updatePrice()
    }
}


async function deleteItem(id, token) {
    const result = await sendJSON("/cart/delete", {product: id, _token: token})
    if(result.status === 200) {
        document.getElementById("item#" + id).remove()
        getItem(id).pivot.amount = 0
        updatePrice()
    }
}

async function buyItems(token) {
    const result = await sendJSON("/cart/buy", {_token: token})

    if(result.status === 200) {
        document.getElementById("items").innerHTML = ""
        items = []
        updatePrice()
    }
}

async function clearItems(token) {
    const result = await sendJSON("/cart/clear", {_token: token})

    if(result.status === 200) {
        document.getElementById("items").innerHTML = ""
        items = []
        updatePrice()
    }
}

function updatePrice() {
    const priceLabel = document.getElementById("total_price")
    let price = 0

    for(const item of items) {
        if(item.pivot.amount === 0) continue
        const itemDiv = document.getElementById("item#" + item.id);
        const itemPriceLabel = itemDiv.getElementsByClassName("price")[0]

        const itemPrice = item.unit_price * item.pivot.amount

        itemPriceLabel.innerHTML = itemPrice.toFixed(2) + " €"
        price += itemPrice
    }

    priceLabel.innerHTML = "Total: " + price.toFixed(2) + " €"
}
