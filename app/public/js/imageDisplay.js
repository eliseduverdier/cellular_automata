// --------------------------------------
//       display image on startup and submit
// --------------------------------------
function displayImage(e) {
    console.log(' >>> Generating image ')

    let parameters = {
        o: Ʊ('input[name="o"]') ? Ʊ('input[name="o"]').value : 2,
        s: Ʊ('input[name="s"]') ? Ʊ('input[name="s"]').value : 2,
        r: Ʊ('input[name="r"]') ? Ʊ('input[name="r"]').value : '',
        w: Ʊ('input[name="w"]') ? Ʊ('input[name="w"]').value : 300,
        h: Ʊ('input[name="h"]') ? Ʊ('input[name="h"]').value : 300,
        p: Ʊ('input[name="p"]') ? Ʊ('input[name="p"]').value : 2,
        start: Ʊ('input[name="start"]').checked ? 1 : 0,
        c0: Ʊ('input[name="c0"]') ? Ʊ('input[name="c0"]').value : '',
        c1: Ʊ('input[name="c1"]') ? Ʊ('input[name="c1"]').value : '',
        c2: Ʊ('input[name="c2"]') ? Ʊ('input[name="c2"]').value : '',
        c3: Ʊ('input[name="c3"]') ? Ʊ('input[name="c3"]').value : '',
        c4: Ʊ('input[name="c4"]') ? Ʊ('input[name="c4"]').value : '',
        c5: Ʊ('input[name="c5"]') ? Ʊ('input[name="c5"]').value : '',
        c6: Ʊ('input[name="c6"]') ? Ʊ('input[name="c6"]').value : '',
        c7: Ʊ('input[name="c7"]') ? Ʊ('input[name="c7"]').value : '',
        c8: Ʊ('input[name="c8"]') ? Ʊ('input[name="c8"]').value : '',
        c9: Ʊ('input[name="c9"]') ? Ʊ('input[name="c9"]').value : '',
    }

    let search = ''
    for (const prop in parameters) {
        if (parameters[prop]) {
            search += prop + '=' + encodeURIComponent(parameters[prop]) + '&'
        }
    }

    let img = new Image()
    img.src = Ʊ('form').action + '?' + search + '_t=' + new Date().getTime()
    Ʊ('section#image').replaceChild(img, Ʊ('section#image img'));

    if (e) e.preventDefault();
}

displayImage();
Ʊ('form[id="display"]').addEventListener("submit", function (e) { displayImage(e) });
