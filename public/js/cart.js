function sendJSON(url, data, method = "POST") {

    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest()
        xhr.open(method, url)

        xhr.setRequestHeader("Content-Type", "application/json")

        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                resolve(xhr)
            }
        }

        xhr.onerror = e => reject(xhr.statusText)

        xhr.send(JSON.stringify(data))
    })
}

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
                itemAdd.enable()
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

async function deleteItem(id, token) {
    const result = await sendJSON("/cart/delete", {product: id, _token: token})
    if(result.status === 200) {
        document.getElementById("item#" + id).remove()
    }
}
