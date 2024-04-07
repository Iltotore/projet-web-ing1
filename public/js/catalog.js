let products = []
let selectedId = -1
let token = ""

async function getProducts(category) {
    result = await sendJSON("/catalog/products?category=" + category, {}, "GET")
    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        const container = document.getElementById("container")
        for (let i = 0; i < jsonResponse.length; i++) {
            const product = jsonResponse[i]
            const productCard =
                `
                <div class="product" onclick="showProduct(${product.id})">
                    <img src="/product/${product.icon}" alt="icon"/>
                    <label>${product.name}</label>
                    <label>${product.unit_price}€</label>
                    <label>En stock: ${product.amount}</label>
                </div>
                `
            container.innerHTML += productCard
        }

        return jsonResponse
    }

    return undefined
}

async function loadProducts(t) {
    const params = new URLSearchParams(window.location.search)
    products = await getProducts(params.has("category") ? params.get("category") : 0)
    token = t
}

async function showProduct(id) {
    const details = document.getElementById("details")
    const icon = document.getElementById("icon")
    const name = document.getElementById("name")
    const price = document.getElementById("price")
    const available = document.getElementById("available")
    const description = document.getElementById("description")
    const amount = document.getElementsByName("amount")[0]

    if(products === undefined) return
    let product = products.find(p => p.id === id)

    if(product === undefined) return

    selectedId = id

    details.hidden = false
    icon.src = `/product/${product.icon}`
    name.innerHTML = product.name
    price.innerHTML = `${product.unit_price}€`
    available.innerHTML = product.amount
    description.innerHTML = product.description
    amount.value = 1
}

function closeProduct() {
    document.getElementById("details").hidden = true
}

async function addItem() {
    const amount = document.getElementsByName("amount")[0].value

    const result = await sendJSON("/cart/add", {
        product: selectedId,
        amount: amount,
        _token: token
    })

    const itemAdd = document.getElementById("add")

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAdd.disabled = false
                break

            case "full":
                itemAdd.disabled = true
                break
        }
    }
}

async function removeItem() {
    const amount = document.getElementsByName("amount")[0].value

    const result = await sendJSON("/cart/remove", {
        product: selectedId,
        amount: amount,
        _token: token
    })

    const itemAdd = document.getElementById("add")

    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        switch (jsonResponse.state) {
            case "ok":
                itemAdd.disabled = false
                break

            case "full":
                itemAdd.disabled = true
                break

            case "doesNotExist":
            case "delete":
        }
    }
}
