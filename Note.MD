{{ route('admin.user.create', [43]) }}

{{ HTML::linkRoute('items.show', 'Show item #4', array(4)) }}

Слідкувати за змінами файлу (логів) в реальному часі. Тільки для лінукс!
```tail -f /log/any.log```

# Великий текст за втопереносом
# print('''Hello
# World''')

# Введення даних в консолі
# i = input("Як Вас звати: ")
# print(i)

# Вивести строку 10 раз
# print('Something strin...' * 10)

#test1 = 'Тестова строка'
#test2 = 2
#print(test1 + str(test2))

# Видалення перемінної
#del(test1)

#МЕТАСИНТАКСИЧНІ ПЕРЕМІННІ зарезервовані системою

from tkinter import *

root = Tk()
root.title('Бомба')
root.geometry('500x500')

root.mainloop()


```
<?php
    $data = array(
        (object)array(
            'id' => 1,
            'name' => 'first prject',
            'prj_id' => null,
        ),
        (object)array(
            'id' => 2,
            'name' => 'second prject',
            'prj_id' => null,
        ),
        (object)array(
            'id' => 3,
            'name' => 'three prject',
            'prj_id' => 2
        ),
        (object)array(
            'id' => 4,
            'name' => 'four prject',
            'prj_id' => 3,
        ),
        (object)array(
            'id' => 5,
            'name' => 'five prject',
            'prj_id' => 4,
        ),
        (object)array(
            'id' => 6,
            'name' => 'five prject',
            'prj_id' => 2,
        ),
        
    );
	
	function getTree($data, $parentId)
	{
		$childrens = array_filter($data, function ($element) use ($parentId)
		{
			/*Вертає масив елементів де $data->prj_id == $parentId */
			return $element->prj_id == $parentId; }
		);
		foreach ($childrens as $children) {
			$arrayOfElements = getTree($data, $children->id);
			if (!empty($arrayOfElements)) {
				$children->children = array_merge($arrayOfElements);
			}
		}

		return $childrens;
	}

	$d = getTree($data, null);


	echo "<pre>";
	echo print_r($d);
	echo "</pre>";
  ```
