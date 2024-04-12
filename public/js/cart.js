let items;

async function addItem(id, token) {
    const result = await sendJSON("/cart/add", {
        product: id,
        amount: 1,
        _token: token
    })

    const itemDiv = document.getElementById("item#" + id);
    const itemAmount = itemDiv.getElementsByClassName("amount")[0]
    const itemAdd = itemDiv.getElementsByClassName("add")[0]

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = false
                break

            case "full":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = true
                break
        }
    }
}

async function removeItem(id, token) {
    const result = await sendJSON("/cart/remove", {
        product: id,
        amount: 1,
        _token: token
    })

    const itemDiv = document.getElementById("item#" + id);
    const itemAmount = itemDiv.getElementsByClassName("amount")[0]
    const itemAdd = itemDiv.getElementsByClassName("add")[0]

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = false
                break

            case "full":
                itemAmount.innerHTML = "x" + jsonResponse.amount
                itemAdd.disabled = true
                break

            case "doesNotExist":
            case "delete":
                itemDiv.remove()
        }
    }
}

async function loadItems(token) {
    const result = await sendJSON("/cart/get", {_token: token});

    if (result.status === 200) {
        items = JSON.parse(result.responseText);
    }
}

async function deleteItem(id, token) {
    const result = await sendJSON("/cart/delete", {product: id, _token: token})
    if(result.status === 200) {
        document.getElementById("item#" + id).remove()
    }
}

async function buyItems(token) {
    const result = await sendJSON("/cart/buy", {_token: token})

    if(result.status === 200) {
        document.getElementById("items").innerHTML = ""
    }
}

async function clearItems(token) {
    const result = await sendJSON("/cart/clear", {_token: token})

    if(result.status === 200) {
        document.getElementById("items").innerHTML = ""
    }
}

function updatePrice() {
    //TODO Update price
}
