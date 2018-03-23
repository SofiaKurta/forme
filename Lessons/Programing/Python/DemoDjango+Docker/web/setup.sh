#!/usr/bin/env bash
PS3='Пожалуйста, введите свой выбор: '
options=("Обновление" "Принудительное обновление" "Выход")
select opt in "${options[@]}"
do
    case $opt in
        "Обновление")
            pip3 install --no-cache-dir -r requirements.txt
            echo "готово."
            ;;
        "Принудительное обновление")
            pip3 install --upgrade --force-reinstall -r requirements.txt
            echo "готово."
            ;;
        "Выход")
            break
            ;;
        *) echo invalid option;;
    esac
done