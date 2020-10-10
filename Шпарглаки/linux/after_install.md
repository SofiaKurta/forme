### How to Hide Mounted Drives From the Left Dock in Ubuntu 19.10
+ Hide: ```gsettings set org.gnome.shell.extensions.dash-to-dock show-mounts false```
+ Show: ```gsettings reset org.gnome.shell.extensions.dash-to-dock show-mounts```

### Move the window control buttons to the left or right with dconf-editor
```sudo apt-get install dconf-editor``` \
path to options of location "close button" on window: ```org → gnome → desktop → wm → preferences```
