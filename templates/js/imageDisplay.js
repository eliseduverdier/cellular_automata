// --------------------------------------
//       display image on submit
// --------------------------------------
Ʊ('form[id="display"]').addEventListener("submit", function(e) {
    console.log(' >>> Generating image ')

    let parameters = {
        s: Ʊ('input[name="s"]') ? Ʊ('input[name="s"]').value : 2,
        r: Ʊ('input[name="rule"]') ? Ʊ('input[name="rule"]').value : 'random',
        w: Ʊ('input[name="w"]') ? Ʊ('input[name="w"]').value : 300,
        h: Ʊ('input[name="h"]') ? Ʊ('input[name="h"]').value : 300,
        p: Ʊ('input[name="p"]') ? Ʊ('input[name="p"]').value : 3,
        start: Ʊ('input[name="start"]') ? Ʊ('input[name="start"]').value : 0,
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
    
    search = ''
    for (const prop in parameters) {
        if (parameters[prop]) {
            search += prop+'='+encodeURIComponent(parameters[prop])+'&'
        }
    }

    let img = new Image()
    img.src = '../img.php?'+search+'_t='+new Date().getTime()
    Ʊ('section#image').replaceChild(img, Ʊ('section#image img'));
 console.log(img.src);

    e.preventDefault();
});
