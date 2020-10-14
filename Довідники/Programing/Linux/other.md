#### Парсинг сайтів через wget
wget -e robots=off --page-requisites --user-agent="Mozilla/5.0 (Windows NT 6.1; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0" --recursive http://example.com

#### Відкриття декількох вкладок в браузері через bash скрипт
```#!/bin/bash
url="https://google.com/"
url2="https://bing.com"
google-chrome -new-window $url -new-tab $url2 &```
```chmod u+x open_faucet.sh```
