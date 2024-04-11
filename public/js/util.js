function sendJSON(url, data, method = "POST") {

    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest()
        xhr.open(method, url)

        xhr.setRequestHeader("Content-Type", "application/json")
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")

        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                try {
                    const json = JSON.parse(xhr.responseText)
                    if(json.hasOwnProperty("redirect")) {
                        window.location.href = json.redirect
                        reject()
                    }
                } catch (e) {}
                resolve(xhr)
            }
        }

        xhr.onerror = e => reject(xhr.statusText)

        xhr.send(JSON.stringify(data))
    })
}

