export function isNumber(event) {
    const char = String.fromCharCode(event.keyCode)
    if (/^[0-9,]+$/.test(char)) return true
    event.preventDefault()
}
