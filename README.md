# valet-dashboard

A simple dashboard for Laravel Valet to display all available sites.

![image](preview.png)

A super minimal dashboard which lists each available site for all parked paths as well as Valet-linked sites.

## Installation

1. Clone or download the repo 
E.g. `git clone https://github.com/aaemnnosttv/valet-dashboard.git`
2. open `~/.config/valet/config.json` & add the `"default"` key:
```json
{
    "domain": "dev",
    "paths": [
        "/Users/yourmac/yourpath"
    ],
    "default": "/Users/yourmac/yourpath/valet-dashboard",
    "tld": "test"
}
```
3. Go to http://localhost anytime to bring up your dashboard
