function updateCounterSubject() {
    let textarea = document.getElementsByName("subject")[0];
    let charCount = document.getElementById("counterSubject");
    let maxChars = parseInt(textarea.getAttribute("maxlength"));

    if (textarea.value.length > maxChars) {
        textarea.value = textarea.value.substring(0, maxChars);
    }
    charCount.textContent = textarea.value.length + "/" + maxChars;
}

function updateCounterContent() {
    let textarea = document.getElementsByName("content")[0];
    let charCount = document.getElementById("counterContent");
    let maxChars = parseInt(textarea.getAttribute("maxlength"));

    if (textarea.value.length > maxChars) {
        textarea.value = textarea.value.substring(0, maxChars);
    }
    charCount.textContent = textarea.value.length + "/" + maxChars;
}
