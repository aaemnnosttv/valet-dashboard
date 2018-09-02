<?php
$valet_xdg_home = getenv('HOME') . '/.config/valet';
$valet_old_home = getenv('HOME') . '/.valet';
$valet_home_path = is_dir($valet_xdg_home) ? $valet_xdg_home : $valet_old_home;
$valet_config = json_decode(file_get_contents("$valet_home_path/config.json"));
$tld = isset($valet_config->tld) ? $valet_config->tld : $valet_config->domain;
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
        <style>
            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                justify-items: center;
            }
        </style>
    </head>
    <body class="m-12 font-sans">
        <div class="grid">
            <?php foreach ($valet_config->paths as $parked_path) : ?>
                <div class="leading-normal whitespace-no-wrap">
                    <code class="font-mono text-grey-dark"><?= $parked_path ?></code>
                    <ul>
                        <?php foreach (scandir($parked_path) as $site) : ?>
                            <?php if ((is_dir("$parked_path/$site") || is_link("$parked_path/$site")) && $site[0] != '.') : ?>
                            <li><a href="http://<?= "$site.$tld" ?>/" target="<?= "valet_$site" ?>"
                                class="text-blue hover:text-blue-light no-underline hover:underline"><?= "$site.$tld" ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </body>
</html>
