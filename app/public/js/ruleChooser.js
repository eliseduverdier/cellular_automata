// --------------------------------------
//      rule: random or number
// --------------------------------------
Ʊ('input[name="random"]').addEventListener("change", function() {
    Ʊ('label[for="rule"]').setAttribute(
        'style',
        'text-decoration: ' + (this.checked ? 'line-through' : 'none') + ''
    )
    Ʊ('input[id="rule"]').value = ''
    if (this.checked) {
        Ʊ('input[id="rule"]').setAttribute('disabled', true)
    } else {
        Ʊ('input[id="rule"]').removeAttribute('disabled')
    }
})