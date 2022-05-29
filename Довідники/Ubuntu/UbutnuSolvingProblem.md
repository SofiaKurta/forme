### Удаление программ
```sudo apt-get purge mysql*``` mysql for example \
```sudo apt-get autoremove``` \
```sudo apt-get autoclean```

### шлях до ярликів з програмами
+ /var/lib/snapd/desktop/applications
+ /usr/share/applications 
+ /home/${USERNAME}/.local/share/applications \
or 
+ sudo apt install --no-install-recommends gnome-panel
+ gnome-desktop-item-edit ~/ --create-new

#### Swap on/off
```sudo nano /etc/fstab``` - manually. you need comment line "#/swapfile" \
or \
```sudo sed -i '/ swap / s/^\(.*\)$/#\1/g' /etc/fstab``` \
or \
```sudo sed -i '/ swap / s/^/#/' /etc/fstab```

#### Clear swap memory
The default value for swappiness is 60; however, you can manually set it anywhere between 0-100. \
Check your current swappiness: \
```cat /proc/sys/vm/swappiness``` \
Set new: \
```sudo sysctl vm.swappiness=30``` \
To make this parameter persistent across reboots, append the following line to the \
```sudo nano /etc/sysctl.conf``` \
```vm.swappiness=10```

#### Change swap size
```sudo swapoff -a``` & ```sudo rm -f /swapfile``` \
**if** = input file \
**of** = output file \
**bs** = block size \
**count** = multiplier of blocks \
Create new swap space of size 16 GB (16 * 1024 = 16384). bs is the block size. Basically bs * count = bytes to be allocated (in this case 16 GB). Here bs = 1M (M stands for mega, so we are assigning 1MB block size) and we are allocating 16384 * 1MB (=16GB) to swap. \
```sudo dd if=/dev/zero of=/swapfile bs=1M count=16384``` \
Give it the read/write permission for root \
```sudo chmod 600 /swapfile``` \
Format it to swap \
```sudo mkswap /swapfile```
Turn on swap again \
```sudo swapon /swapfile```
Edit /etc/fstab and add the new swapfile if it isn’t already there \
```/swapfile none swap sw 0 0```
Check the amount of swap available \
```grep SwapTotal /proc/meminfo```

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

### делаем нормальную смену языка в ununtu 18.04 (GNOME3)
```gsettings set org.gnome.desktop.wm.keybindings switch-input-source "['']"``` \
(backup ) ```gsettings set org.gnome.desktop.wm.keybindings switch-input-source "['<CTRL>Shift_L']"``` \
  или идем вручную: ```dconf-editor по пути org.gnome.desktop.wm.keybindings``` \
  и в gnome tweak tool забиндить клавишу, например: CAPS LOCK или другое сочетание.

#### How to Hide Mounted Drives From the Left Dock in Ubuntu 19.10
+ Hide: ```gsettings set org.gnome.shell.extensions.dash-to-dock show-mounts false```
+ Show: ```gsettings reset org.gnome.shell.extensions.dash-to-dock show-mounts```

#### Move the window control buttons to the left or right with dconf-editor
```sudo apt-get install dconf-editor``` \
path to options of location "close button" on window: ```org → gnome → desktop → wm → preferences```

#### E: Sub-process /usr/bin/dpkg returned an error code (1)
```for file in $(LANG=C dpkg-divert --list | grep nvidia-340 | awk '{print $3}'); do sudo dpkg-divert --remove $file; done``` \
```sudo apt install --fix-broken```

#### Проблемы воспроизведения гарнитуры Bluetooth
Некоторые пользователи сообщают о больших задержках или даже отсутствии звука, когда по Bluetooth-соединению не передаются никакие данные. Это вызвано модулем ```module-suspend-on-idle```, который автоматически приостанавливает устройства ввода/вывода при простое. Так как это может вызвать проблемы с гарнитурой, можно отключить соответствующий модуль.

Для отключения загрузки модуля module-suspend-on-idle закомментируйте следующую строчку в используемом файле конфигурации (```~/.config/pulse/default.pa``` или ```/etc/pulse/default.pa```): \
```sudo nano /etc/pulse/default.pa``` \
```#load-module module-suspend-on-idle```

#### PlayOnLinux Adobe Air requires a version that is not available
```sudo apt-get install liblcms2-2:i386```

#### Read-only file system on a mounted disk with Windows
To disable hibernation, type ```powercfg -h off``` at the command prompt and press Enter. Click on win+X in Windows 10 that open command prompt as administrator. This will disable this mode, delete the file hiberfil.sys from the hard drive, as well as disable the Windows 10 quick start option (which also uses this technology and does not work without hibernation).

### fix the GPG error "NO_PUBKEY"
1. To install it, first add the webupd8 repository for this program:

```sudo add-apt-repository ppa:webupd8team/y-ppa-manager``` \

2. Update your software list and install Y-PPA-Manager:

```sudo apt-get update``` \
```sudo apt-get install y-ppa-manager``` \

3. Run y-ppa-manager (i.e. type ```y-ppa-manager``` then press enter key).

4. When the main y-ppa-manager window appears, click on "Advanced."

5. From the list of advanced tasks, select "Try to import all missing GPG keys" and click OK.

You're done! As the warning dialog says when you start the operation, it may take quite a while (about 2 minutes for me) depending on how many PPA's you have and the speed of your connection.

### Remove all bluetooth devices
before run the script you need installing: ```sudo apt-get install bluez-tools```\
#!/bin/bash
```
for device in $(bt-device -l | grep -o "[[:xdigit:]:]\{11,17\}"); do
    echo "removing bluetooth device: $device | $(bt-device -r $device)"
done
```
