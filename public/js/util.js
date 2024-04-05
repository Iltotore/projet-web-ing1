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
