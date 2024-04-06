async function getProducts(category) {
    result = await sendJSON("/catalog/products?category=" + category, {}, "GET")
    if(result.status === 200) {
        const jsonResponse = JSON.parse(result.responseText)
        const container = document.getElementById("container")
        for (let i = 0; i < jsonResponse.length; i++) {
            const product = jsonResponse[i]
            const productCard =
                `
                <div class="product">
                    <img src="/product/${product.icon}" alt="icon"/>
                    <label>${product.name}</label>
                    <label>${product.unit_price}€</label>
                    <label>En stock: ${product.amount}€</label>
                </div>
                `

            container.innerHTML += productCard
        }
    }
}

async function loadProducts() {
    const params = new URLSearchParams(window.location.search)
    await getProducts(params.has("category") ? params.get("category") : 0)
}
