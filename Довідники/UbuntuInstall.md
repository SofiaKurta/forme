## After install Ubuntu

#### Обов'язкове: 
+ Інсталятор *.deb GDebi package installer ```sudo apt-get install gdebi```
+ Установить Midnight Commander: ```sudo apt-get install mc``` Открыть Midnight Commander командой: ```mc```.

### Встановлення відеодрайвера
```
sudo ubuntu-drivers devices
sudo ubuntu-drivers autoinstall
reboot
```

### Step 1: The best programs
[Список кращих програм](https://losst.ru/luchshie-programmy-dlya-ubuntu)
+ [СТАНДАРТНИЙ РЕПОЗИТОРІЙ ПРОГРАМ](https://en.uptodown.com/ubuntu)
+ [Ubuntu After Install — настройка Ubuntu после установки](http://ualinux.com/ru/ubuntu-apps-standard/45929-ubuntu-after-install)
+ [Фотовидеобудка Cheese — снимать фотографии и видео с веб-камеры](http://ualinux.com/ru/ubuntu-apps-multimedia/39816-cheese) 
+ [Intel Graphics Driver Installer](https://01.org/linuxgraphics/downloads)
+ [Аудио плееры в Убунту](http://softhelp.org.ua/?p=3390)
+ [audacious - простий аудіо плеєр](http://audacious-media-player.org/)
+ sudo apt install ubuntu-restricted-extras (КОДАКИ і додатковий пакет програм)

### Step 2: Settings system
+ [Autorun telegram ubuntu](https://askubuntu.com/questions/644762/telegram-at-startup)
+ [Управления приложениями: ```sudo apt-get install synaptic```](https://losst.ru/spisok-ustanovlennyh-programm-v-ubuntu)
+ [Ubuntu cleaner](http://compizomania.blogspot.com/2016/12/linux-ubuntu-cleaner.html)
+ [управление автозагрузкой](http://meandubuntu.ru/2009/04/%D1%83%D0%BF%D1%80%D0%B0%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B0%D0%B2%D1%82%D0%BE%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%BE%D0%B9/)
+ [Linux Advanced Power Management в Ubuntu](http://forum.ubuntu.ru/index.php?topic=219057.0)
+ [Лучшие расширения для Gnome Shell](https://linuxthebest.net/luchshie-rasshireniya-dlya-gnome-shell/)
+ [Лучшие расширения для Gnome Shell2](https://losst.ru/luchshie-rasshireniya-gnome-3#1_Dash_to_Dock)
+ [Как устанавливать расширения для GNOME3](https://itsfoss.com/gnome-shell-extensions/)

### Список розширень для GNOME3
+ [Minimize All Windows](https://extensions.gnome.org/extension/760/minimize-all/)
+ [TaskBar(optional)](https://extensions.gnome.org/extension/584/taskbar/)
+ [No Title Bar](https://extensions.gnome.org/extension/1267/no-title-bar/)
+ [Langswitcher](https://extensions.gnome.org/extension/733/langswitcher/)

### делаем нормальную смену языка в ununtu 18.04 (GNOME3)
gsettings set org.gnome.desktop.wm.keybindings switch-input-source "['']" \
(backup ) gsettings set org.gnome.desktop.wm.keybindings switch-input-source "['<CTRL>Shift_L']" \
  или идем вручную: dconf-editor по пути org.gnome.desktop.wm.keybindings \
  и в gnome tweak tool забиндить клавишу, например: CAPS LOCK или другое сочетание.
  

## Удаление программ
```
sudo apt-get purge mysql*
sudo apt-get autoremove
sudo apt-get autoclean
```

## If you have problems with ubuntu:
+ [Создание ярлыков](http://www.linuxrussia.com/shortcut-ubuntu-sh.html)
+ Полная очистка корзины
```sudo rm -rf ~/.local/share/Trash/files/* ~/.local/share/Trash/info/*```
+ Отключение подтв. пароля для раблокировки вязки ключей: ```alt+f2 > seahorse > Gnome keyring > Unlock```

## Встановлення JDK та налаштування JAVA на Linux Ubuntu

### Встановлення JDK
+ [Встановлення JDK на UBUNTU](https://www.digitalocean.com/community/tutorials/java-ubuntu-apt-get-ru)
+ ```sudo apt-get install openjdk-8-jre```
+ Ручний режим
```
cd /usr/local
tar xzf <the file you just downloaded>
As your normal user, add or change these two lines in your ~/.profile to point to the installation;

sudo nano /etc/environment
export JAVA_HOME=/usr/local/jdk1.7.0_13
export PATH=$PATH:$JAVA_HOME/bin
source /etc/environment #Застосувати нові зміни
echo $JAVA_HOME #Перевірити чи відкривається шлях
```


### Запуск jar файлів без командної строки
+ Створюємо ярлик в папці ```/usr/share/applications``` з назвою ```java.desktop```
+ Вміст: (Exec - шлях прописуємо бінарніка java)
```
[Desktop Entry]
Name=Java
Comment=Java
GenericName=Java
Keywords=java
Exec="/usr/lib/jdk1.8.0_144/jre/bin/java" -jar %f
Terminal=false
X-MultipleArgs=false
Type=Application
MimeType=application/x-java-archive
StartupNotify=true
```

### Пошук в командній строці
+ -type d | f
+ ```find / -type f -iname "filename*"```

### Disable Apport at Boot (Disable Error Reporting)
+ Stop Apport: ```sudo service apport stop```
+ Disable Apport at Boot: ```sudo nano /etc/default/apport```
+ Uninstall Apport: ```sudo apt-get purge apport```
