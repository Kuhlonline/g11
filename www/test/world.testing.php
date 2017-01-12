<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


        <title class="title"></title>
        <meta name="description" class="subtitle" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="../assets/img/icon.png">
        <!--[if IE]>
            <link rel="shortcut icon" href="../assets/img/icon.ico">
        <![endif]-->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../assets/css/theme.css">

        <!-- Main CSS -->
        <link rel="stylesheet" href="../assets/css/main.css">

        <!-- Game CSS -->
        <link rel="stylesheet" href="../assets/css/game.css">

        <!-- Data Table CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

        <!-- Manifest -->
        <link rel="manifest" href="../assets/manifest.json">


    </head>
    <body>



        <div class="grid">
            <span class="tod"></span>
            <br>
            X <input id="x" value="5">
            <br>
            Y <input id="y" value="5">
            <br>
            
            <table class="world-table map-base">
                <tbody>
                    <tr>
                        <td class="i1 x1 y1">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i2 x2 y1">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i3 x3 y1">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i4 x4 y1">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i5 x5 y1">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="i6 x1 y2">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i7 x2 y2">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i8 x3 y2">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i9 x4 y2">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i10 x5 y2">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="i11 x1 y3">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i12 x2 y3">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i13 x3 y3">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i14 x4 y3">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i15 x5 y3">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="i16 x1 y4">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i17 x2 y4">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i18 x3 y4">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i19 x4 y4">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i20 x5 y4">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="i21 x1 y5">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i22 x2 y5">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i23 x3 y5">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i24 x4 y5">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                        <td class="i25 x5 y5">
                            <span class="layer layer0">&nbsp;</span>
                            <span class="layer layer1 rock">&nbsp;</span>
                            <span class="layer layer2 sand">&nbsp;</span>
                            <span class="layer layer3 dirt">&nbsp;</span>
                            <span class="layer layer4 water">&nbsp;</span>
                            <span class="layer layer5 nature">&nbsp;</span>
                            <span class="layer layer6 items">&nbsp;</span>
                            <span class="layer layer7 npcs">&nbsp;</span>
                            <span class="layer layer8 players">&nbsp;</span>
                            <span class="layer layer9 weather">&nbsp;</span>
                            <span class="layer layer10 heat">&nbsp;</span>
                            <span class="layer layer11 light">&nbsp;</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-primary" onclick="test_world_location_load()">Test</button>

            <div>
            <strong>Light</strong>
            <ul class="nav">
                <li><a onclick="mask('light', 'morning');">Morning</a></li>
                <li><a onclick="mask('light', 'day');">Day</a></li>
                <li><a onclick="mask('light', 'evening');">Evening</a></li>
                <li><a onclick="mask('light', 'night');">Night</a></li>
                <li><a onclick="mask('light', '');">None</a></li>
            </ul>
            </div>

            
            <div>
            <strong>Weather</strong>
            <ul class="nav">
                <li><a onclick="mask('weather', 'clouds');">Rain Clouds</a></li>
                <li><a onclick="mask('weather', '');">None</a></li>
            </ul>
            </div>
        </div>

         <!-- JQuery 2.2.4 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <!-- Data Tables -->
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <!-- Libraries (JS) -->
        <script src="../assets/js/lib/webcore.js"></script>

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Global JS -->
        <script src="../assets/js/global.js"></script>


        <script>

            function mask(target, mask) {
                $('.'+target)
                    .removeClass('night')
                    .removeClass('day')
                    .removeClass('evening')
                    .removeClass('morning')
                    .removeClass('clouds')
                    .addClass(mask);
                ;
            }


            function tod() {
                api.invoke("\\game\\world", "time_of_day", {}, function(result) {
                    $('.tod').html(result.response.date_time);
                });
            }

            function test_world_location_load() {
                api.endpoint    = "../api/v1/";

                var payload = {
                    "x":    $('#x').val(),
                    "y":    $('#y').val(),
                    "size": 2
                };

                api.invoke("\\game\\world", "view", payload, function(result) {
                    var tiles   = result.response;

                    for (var index in tiles) {

                        //Tile Data
                        var tile        = tiles[index];
                        var tileIndex   = (parseInt(index) + 1);

                        //Tile Element
                        var targetTile  = "td.i" + tileIndex;
                        var $tile       = $(targetTile);

                        //Set Layers
                        var $layers  = [];
                        for (i = 0; i <= 12; i++) {
                            $layers[i]   = $(targetTile + ">span.layer" + i);
                        }

                        //Set Layer Classes

                            //Base Color
                            $layers[0].addClass(tile.mode + '-color');

                            //Materials
                            $layers[1]
                                .css('opacity', 1)
                                .removeClass('rock')
                                .removeClass('sand')
                                .removeClass('dirt')
                                .removeClass('water')
                                .addClass(tile.mode)
                                .css('opacity', parseInt(tile[tile.mode]) / 10)
                            ;

                            /*$layers[2].css('opacity', 1).addClass('sand').css('opacity', parseInt(tile.sand) / 5);
                            $layers[3].css('opacity', 1).addClass('dirt').css('opacity', parseInt(tile.dirt) / 5);
                            $layers[4].css('opacity', 1).addClass('water').css('opacity', parseInt(tile.water) / 5);*/


                            //Content
                            $layers[5].html(tile.mode + " " + tileIndex + " -> x" + tile.x + " y" + tile.y);

                        


                    }
                });
            }

        </script>

    </body>
</html>