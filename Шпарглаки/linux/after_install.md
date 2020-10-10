##### Інсталятор пакунків *.deb GDebi
(в кого проблеми з звичайним інсталятором, виникають підвисання, виникнення неочікуваних помилок тощо...) \
```sudo apt-get install gdebi```

##### Midnight Commander
двухпанельний консольний файловий менеджер. Вміє працювати на серверах де відсутня графічна оболочка. Незважаючи на явно несучасний дизайн, Midnight Commander все ж досить потужний інструмент. Він підтримує Samba, FTP і SFTP, вміє працювати з архівами і образами як зі звичайними папками. \
```sudo apt-get install mc```

##### 1.Встановлення tweak утиліти
```sudo apt install -y gnome-tweak-tool```
##### 2.Підтримка 32-біт бібліотек
```sudo apt install -y libc6:i386 libasound2:i386 libasound2-data:i386 libasound2-plugins:i386 libgtk2.0-0:i386 libsdl2-2.0-0:i386 libsdl2-image-2.0-0:i386 libfreetype6:i386 libcurl3:i386```

##### 3.Архіватори
```sudo apt install -y p7zip-rar rar unrar unace arj cabextract```

##### 4.Пакет JDK, JRE і плагін для браузера
```sudo add-apt-repository -y ppa:webupd8team/java``` \
```sudo apt update``` \
```sudo apt install -y oracle-java8-installer```

##### 5.Оновлення мікрокоду
#INTEL \
```sudo apt install --reinstall intel-microcode``` \
#AMD \
```sudo apt install --reinstall amd64-microcode```

##### 6.Оновлення драйверів
NVIDIA NATIVE DRIVER \
для ПК: \
```sudo add-apt-repository -y ppa:graphics-drivers/ppa``` \
```sudo apt update```

ДЛЯ НОУТБУКІВ NVIDIA \
```sudo apt install -y nvidia-361 nvidia-settings nvidia-prime```

ДЛЯ НОУТІВ\ПК INTEL\AMD \
```sudo add-apt-repository -y ppa:paulo-miguel-dias/pkppa``` \
```sudo apt update```

##### 7.Управління користувачами і групами
```sudo apt install -y gnome-system-tools```

##### 8.Установка grub customizer – приложение для настройки загрузчика grub
```sudo add-apt-repository -y ppa:danielrichter2007/grub-customizer``` \
```sudo apt update``` \
```sudo apt install -y grub-customizer```

##### 9.Встановлення SYNAPTIC - це програма графічним інтерфейсом, що дозволяє управляти пакетами в Ubuntu
```sudo apt-get install synaptic```

##### 10. Встановлення GOOGLE CHROME
```wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -``` \
```sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" » /etc/apt/sources.list.d/google-chrome.list'``` \
```sudo apt update``` \
або вручну: \
```sudo nano /etc/apt/sources.list.d/google-chrome.list``` \
```deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main``` \
А тепер на вибір: \
```sudo apt install google-chrome-stable``` \
```sudo apt install google-chrome-beta``` \
```sudo apt install google-chrome-unstable```


#### PRELOAD
Встановлення PRELOAD - демон, який збирає інформацію про програми, які найбільш частіше використовуються, і кешуючий їх і, які вони вживали бібліотеки, що призводить до підвищення швидкості завантаження програм. Для установки потрібно просто виконати в терміналі. \
```sudo apt-get install preload``` \
або запустити Центр додатків Ubuntu, знайти в ньому preload і встановити його. Після установки preload перезавантажте комп'ютер і виконайте в консолі команди.

#### Список розширень для GNOME3
Рекомендую ставити розширення через браузер firefox (Gnome shell integration). Список рекомендованих доповнень (на сайті: https://extensions.gnome.org/) \
```sudo apt install -y chrome-gnome-shell```
+ Minimize All - Згорнути всі вікна в поточній робочій області
+ No Title Bar - переміщує назву вікна та кнопки на верхню панель

#### Список програм, які інсталюються через Market
+ VLC (VideoPlayer)
+ Simple Screen Recorder
+ FileZilla - багатоплатформний клієнт FTP
+ Gpick - колірна піпетка
+ Gimp - графічний редактор
+ Audacious (AudioPlayer)
+ PCManFM (FileManager)
+ Telegram - месенджер  (автозавантаження команда telegram-desktop)
+ PlayOnLinux - надстройка над Wine, дозволяє запускати програми з windows
+ Sublime text / Atom - текстові редактори (на вибір).

#### Список програм, які встановлюються вручну.
+ PhpStorm - середовище розробки для php. Також можете переглянути список корисних плагінів, які можуть стати Вам в пригоді.
+ PyCharm - середовище розробки python
+ WebStorm - зручний і розумний редактор для JavaSсript, HTML і CSS ...
+ Photoshop - топовий графічний редактор (як встановити читаємо тут)
+ zealdocs.org - офлайн документація.

#### Enable Numlock, Tap to Click in Ubuntu 18.04 Login Screen
```sudo -i``` \
```xhost +SI:localuser:gdm``` \
```su gdm -s /bin/bash``` \
In this terminal, run command to enable numlock automatically in login screen: \
```gsettings set org.gnome.settings-daemon.peripherals.keyboard numlock-state 'on'``` \
To enable tap to click, run command in the same terminal: \
```gsettings set org.gnome.desktop.peripherals.touchpad tap-to-click true```

#### How to Hide Mounted Drives From the Left Dock in Ubuntu 19.10
+ Hide: ```gsettings set org.gnome.shell.extensions.dash-to-dock show-mounts false```
+ Show: ```gsettings reset org.gnome.shell.extensions.dash-to-dock show-mounts```

#### Move the window control buttons to the left or right with dconf-editor
```sudo apt-get install dconf-editor``` \
path to options of location "close button" on window: ```org → gnome → desktop → wm → preferences```
