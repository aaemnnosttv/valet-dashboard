<?php
$valet_xdg_home = getenv('HOME') . '/.config/valet';
$valet_old_home = getenv('HOME') . '/.valet';
$valet_home_path = is_dir($valet_xdg_home) ? $valet_xdg_home : $valet_old_home;
$valet_config = json_decode(file_get_contents("$valet_home_path/config.json"));
$tld = isset($valet_config->tld) ? $valet_config->tld : $valet_config->domain;
$self = isset($valet_config->default) ? basename($valet_config->default) : 'valet-dashboard';

?>
<html>
<head>
    <title>Valet Dashboard</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="m-12 font-sans">

    <div class="flex flex-wrap">
        <div class="w-1/5">
            <?php foreach ($valet_config->paths as $parked_path) : ?>
                <div class="leading-normal whitespace-no-wrap font-mono text-gray-600">
                    <code><?= str_replace(getenv('HOME'), '~', $parked_path) ?></code>
                    <ol class="list-decimal pl-4 mt-4">
                        <?php foreach (scandir($parked_path) as $site) : ?>
                            <?php if ((is_dir("$parked_path/$site") || is_link("$parked_path/$site")) && $site[0] != '.') : ?>
                                <?php if ($site == $self): continue; endif ?>
                                <li><a href="http://<?= "$site.$tld" ?>/" target="<?= "valet_$site" ?>"
                                       class="text-blue-500 hover:text-blue-400 no-underline hover:underline"><?= "$site.$tld" ?></a>
                                </li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ol>
                </div>
            <?php endforeach ?>
        </div>

        <div class="w-4/5">
            <iframe src="/info.php" frameborder="0" width="100%" height="100%"></iframe>
        </div>

    </div>

</body>
</html>
