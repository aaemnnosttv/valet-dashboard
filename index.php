<?php
$valet_home = getenv('HOME') . '/.valet';
$valet_config = json_decode(file_get_contents("$valet_home/config.json"));
$tld = $valet_config->tld ?: $valet_config->domain;
$parked_paths = $valet_config->paths;
?>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 3rem;
            }
            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                justify-items: center;
            }
            .item {
                white-space: nowrap;
            }
        </style>
    </head>
    <body>
        <div class="grid">
            <?php foreach ($parked_paths as $parked_path) : ?>
                <div class="item">
                    <code><?= $parked_path ?></code>
                    <ul>
                        <?php foreach (array_diff(scandir($parked_path), ['.','..']) as $site) : ?>
                            <?php if (is_dir("$parked_path/$site") || is_link("$parked_path/$site")) : ?>
                            <li><a href="http://<?= "$site.$tld" ?>/" target="<?= "valet_$site" ?>"><?= "$site.$tld" ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </body>
</html>
