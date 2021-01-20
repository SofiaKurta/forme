### шлях до ярликів з програмами
+ /var/lib/snapd/desktop/applications
+ /usr/share/applications \
or 
+ sudo apt install --no-install-recommends gnome-panel
+ gnome-desktop-item-edit ~/ --create-new

#### Примусове очищення кошика в Linux Ubuntu
```sudo rm -rf ~/.local/share/Trash/files/* ~/.local/share/Trash/info/*```

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

#### E: Sub-process /usr/bin/dpkg returned an error code (1)
```for file in $(LANG=C dpkg-divert --list | grep nvidia-340 | awk '{print $3}'); do sudo dpkg-divert --remove $file; done``` \
```sudo apt install --fix-broken```
