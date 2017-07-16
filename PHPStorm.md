## Чиним горячие клавиши PhpStorm в русской раскладке под Ubuntu
В большинстве java-приложений с GUI в ОС Ubuntu в русской раскладке НЕ работают хоткеи, даже стандартные **Ctrl + C** и **Ctrl + V**. Но хороший человек по-имени **Michael Zheludkov** написал фикс данного бага, за что ему огромное человеческое спасибо. \
Установка \
\
Клонируем репозиторий в папку ~/fix/: \

```
git clone https://github.com/zheludkovm/LinuxJavaFixes.git fix
```
Открываем конфиг приложения:
```
nano /opt/PhpStorm/bin/phpstorm64.vmoptions
```
Добавляем в него строку с фиксом:
```
-javaagent:/home/user/fix/build/LinuxJavaFixes-1.0.0-SNAPSHOT.jar
```
**Указывайте абсолютный путь до jar-файла**

Перезапускаем PhpStorm и насладжаемся рабочими хоткеями в русской раскладке.

## Как создать ярлык в Ubuntu для запуска sh (shell) скрипта.
[тык](http://www.linuxrussia.com/shortcut-ubuntu-sh.html)
