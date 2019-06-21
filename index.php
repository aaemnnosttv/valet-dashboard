<?php
$valet_xdg_home = getenv('HOME') . '/.config/valet';
$valet_old_home = getenv('HOME') . '/.valet';
$valet_home_path = is_dir($valet_xdg_home) ? $valet_xdg_home : $valet_old_home;
$valet_config = json_decode(file_get_contents("$valet_home_path/config.json"));
$tld = isset($valet_config->tld) ? $valet_config->tld : $valet_config->domain;
$self = isset($valet_config->default) ? basename($valet_config->default) : 'valet-dashboard';
?>
<html>
    <title>Valet Dashboard</title>
    <head>
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
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
                    <code class="font-mono text-gray-600"><?= str_replace(getenv('HOME'), '~', $parked_path) ?></code>
                    <ul class="list-disc pl-4">
                        <?php foreach (scandir($parked_path) as $site) : ?>
                          <?php if ($site == $self): continue; endif ?>
                            <?php if ((is_dir("$parked_path/$site") || is_link("$parked_path/$site")) && $site[0] != '.') : ?>
                            <li><a href="http://<?= "$site.$tld" ?>/" target="<?= "valet_$site" ?>"
                                class="text-blue-500 hover:text-blue-400 no-underline hover:underline"><?= "$site.$tld" ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </body>
</html>
