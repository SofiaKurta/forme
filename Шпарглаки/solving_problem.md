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
