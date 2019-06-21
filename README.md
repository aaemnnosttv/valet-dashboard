# valet-dashboard

A simple dashboard for Laravel Valet to display all available sites.

![image](preview.png)

A super minimal dashboard which lists each available site for all parked paths as well as Valet-linked sites.

## Installation

1. Clone or download the repo into a directory of your choosing  
E.g. `git clone https://github.com/aaemnnosttv/valet-dashboard.git dashboard`
1. Move the new directory into a Valet-parked path or run `valet link` within it
1. Run `valet open` from within the directory!

## Setup as default site
If you would like to access your dashboard by going to http://localhost,
you have to adjust the Valet config under `~/config/valet/config.json`.

Add the "default" key, like this:
```json
{
    "domain": "dev",
    "paths": [
        "/Users/yourname/yourpath"
    ],
    "default": "/Users/yourname/yourpath/valet-dashboard",
    "tld": "test"
}
```
