## Activation
https://github.com/pofycn/JB_Crack_Setting

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

## PhpStorm/WebStorm Горячие клавиши.

### Общие

| Команда | Mac OS X | Windows/Linux | Description |
| ------- | -------- | ------- | ----------- |
| Preferences/Settings | `CMD + ,` | `Ctrl + Alt + S`  | Открыть настройки программы |
| Switch tabs | `Ctrl + Tab` | `Ctrl + Tab`  | Переключение между открытыми вкладками |
| Search | `Double Shift` | `Double Shift`  | Открыть окно поиска по проекту  |
| New | `CMD + N` | `Ctrl + N`  | Создать новый файл/Директорию |
| Save | `CMD + S` | `Ctrl + S`  | Сохранить изменения в текущем файле |
| Save As | `CMD + Shift + S` | `Ctrl + Shift + S`  | Сохранить изменения в файле с новым именем |
| Close Tab | `CMD + W` |  `Ctrl + F4` | Закрыть текущую вкладку |
| Find in Path | `CMD + Shift + F` |  `Ctrl + Shift + F` | Поиск по всему проекту |



### Редактирование

| Команда | Mac OS X | Windows/Linux | Description |
| ------- | -------- | ------- | ----------- |
| Find | `CMD + F` | `Ctrl + F`  | Поиск по файлу  |
| Replace | `CMD + R` | `Ctrl + R`  | Замена найденных символов  |
| Duplicate Lines | `CMD + D` | `Ctrl + D` | Создать дубликат текущей строки |
| Safe Delete | `CMD + Backspace` | `Ctrl + Y` | Удаление всей текущей строки |
| Select block | `ALT + up` | `Ctrl-W`  | Выделить блок кода (слово/строка/документ)|
| Move Line Up | `CMD + Shift + up` | `Ctrl + Shift + up`  | Переместить текущую строку на одну строку вверх |
| Move Line Down | `CMD + Shift + down` | `Ctrl + Shift + down`  | Переместить текущую строку на одну строку вниз |
| Line comment | `CMD + /` | `Ctrl + /`  |  Добавить строчный комментарий |
| Block comment | `CMD + Shift + /` | `Ctrl + Shift + /`  | Добавить блочный комментарий |
| Reformat code | `CMD + ALT + L` | `Ctrl + ALT + L`  | Восстанавливает форматирование кода, согласно настройкам |
| Multi select | `ALT + Click` | `ALT + J + Click`  | Множественный курсор (нажать и немного подержать - выделит все вхождения) |
| Last Edition Location | `CMD + Shift + Backspace` | `Ctrl + Shift + Backspace`  | Вернуться к предыдущему месту редактирования |
| Rename | `CMD + F6` |  ` ` | Умное переименовывание переменной/атрибута с заменой по проекту |
| Surround with | `CMD + ALT + T` |  ` ` | Оборачивание выделенного кода, в выбраное выражение* |

