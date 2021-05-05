// --------------------------------------
//   number of colors for states
// --------------------------------------
const COLORS_HEX = [null, null, "#242423", "#30d179", "#d4b483", "#c1666b", "#e4dfda", "#48a9a6", "#cfdbd5", "#731dd8", "#333533"];
let template = Ʊ('input[id="color-template"]')

Ʊ('input[id="states"]').addEventListener("change", function(e) {
    let colors = Ω('input[type="color"]')
    let currentColorNodeCount = colors.length - 1 // ignore template
    // console.log('i want:' + this.value + ' / i have: ' + currentColorNodeCount)

    if (this.value < currentColorNodeCount) { // too many colors !
        for (let i = currentColorNodeCount; i > this.value; i--) {
            // console.log('  > removing ' + i + 'th node')
            colors[i].remove()
        }
    } else if (this.value > currentColorNodeCount) { // not enough colors !
        for (let i = currentColorNodeCount; i < this.value; i++) {
            // console.log('  > adding ' + i + 'th node')
            let newcolor = template.cloneNode(true)
            newcolor.removeAttribute('id')
            newcolor.removeAttribute('hidden')
            newcolor.setAttribute('name', 'c' + i)
            newcolor.setAttribute('value', COLORS_HEX[i])
            template.parentNode.appendChild(newcolor);
            template.parentNode.appendChild(document.createTextNode(' '));
        }
    }
})
