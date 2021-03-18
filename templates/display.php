<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Cellular Automata — 2 states — generator</title>
    <link href="../../data/lib/reset.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="icon" type="image/png" href="/data/img/icons/favicon.png" />
  </head>
  <body>

    <nav>
      <h1>elementary <br />cellular <br />automata</h1>
      <div>
        <div><a href="display.php" active>2 states</a> <a href="list.php">(list)</a></div>
        <div><a href="display3.php">3 states</a> <a href="list3.php">(list)</a></div>
        <div><a href="display4.php">4 states</a> <a href="list4.php">(list)</a></div>
      </div>
    </nav>

    <main>
    <form class="display" action="../lib/img.php" target="displayFrame" method="get" >
      <fieldset class="sizes">
        <fieldset>
          <div class="input-group">
            <label for="rule">rule #</label>
            <input type="number" name="rule" id="rule" value="" min="0" max="256" placeholder="N" />
          </div>
          <div class="input-group">
            or <input type="checkbox" name="random" id="random" /><label for="random" >random</label>
          </div>
        </fieldset>

        <fieldset>
          <div class="input-group">
            <label for="width">width:</label> <input type="number" name="width" id="width" value="50" min="0" max="1000" placeholder="N" />
          </div>
          <div class="input-group">
            <label for="height">height:</label> <input type="number" name="height" id="height" value="50" min="0" max="1000" placeholder="N" />
          </div>
          <div class="input-group">
            <label for="scale">pixel:</label> <input type="number" name="pixel" id="scale" value="5" min="1" max="8" placeholder="N" />
          </div>
        </fieldset>

        <fieldset>
          <input type="checkbox" name="randomstart" id="randomstart" />
          <label for="randomstart"> single point on first line</label >
        </fieldset>
      </fieldset>
      <fieldset class="colors">
        <fieldset>
          <div class="input-group">
            <label for="color">color 1</label > <input type="color" name="color" value="#000000" id="color" />
            <br />
          </div>
          <div class="input-group">
            <label for="bgcolor">color 2</label>
            <input type="color" name="bgcolor" value="#ffffff" placeholder="#ffffff" id="bgcolor" />
          </div>
        </fieldset>
      </fieldset>
      <fieldset class="submit">
        <fieldset>
          <input class="submit" type="submit" value="Go !" />
          <input class="reset" type="reset" value="reset" />
        </fieldset>
      </fieldset>
    </form>

    <iframe src="../lib/img.php?random=on&width=50&height=50&pixel=5" height="500" name="displayFrame"> </iframe>
    </main>
    
    <footer>
      <p>
        <!--((See (all (automata (from (random and (single point)) (start lines))))) here)-->
        CC (BY SA) Élise Duverdier 2015
      </p>
    </footer>

    <script type="text/javascript">
      document .querySelector('input[name="random"]') .addEventListener("change", function () {
          document .querySelector('label[for="rule"]') .setAttribute(
              'style',
              'text-decoration: ' + (this.checked ? 'line-through' : 'none') + ';'
            );
        });
    </script>
  </body>
</html>
