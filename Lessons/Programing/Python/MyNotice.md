```print("hello")
print(3 ** 2)  # 3 в степені 2
print(25 // 5)  # показує скільки в числі 25 є п'ятірок
print(25 % 5)  # залишок при діленні

name = input("What is your name")
print("Hi, ", name)

num_1 = '2'
num_2 = '2'
print(int(num_1) + int(num_2))

a = [a + b for a in 'list' if a != 's' for b in 'soup' if b != 'u']
print(a)

l = []
s = [46, 79]

l.append(23)
l.append(25)
l.extend(s)
l.insert(0, 99)
l.remove(25)  # видалиться тільки одне знайдене значення
print(l.index(23))
l.pop(0)
l.sort()
l.reverse()
l.clear()
print(l)

m = [34, 'mtr', 12, 95.3]
print(m[0])
print(m[-1])  # останній елемент списку

# item[START:STOP:STEP]
print(m[::2])  # кожний другий елемент

tuple1 = (12, 45, 14.5, 'asd')  # кортежі міняти не можна
no_tuple = [12, 45, 14.5, 'asd']

print(tuple1.__sizeof__())
print(no_tuple.__sizeof__())

aa = tuple("Hello")  # виведе кожен елемент окремо
print(aa)

d = {'test': 1}
dd = dict(short='dict', longer='dictionary')
ddd = dict.fromkeys(['a', 'b'])  # створюємо ключі без значень
dede = dict.fromkeys(['a', 'b'], 1)  # всім ключам буде призначено значення 1
dada = {a: a ** 2 for a in range(7)}
print(ddd)

# множества
df = set("hello")  # Множество в python - "контейнер", содержащий не повторяющиеся элементы в случайном порядке.
dff = {'32', 23}
af = {i ** 2 for i in range(10)}
print(af)

bf = frozenset("Qerty")
# bf.add = (119)
print(bf)

x = 23
print(x in dff)  # перевіряє чи є таке число

ax = {23, 56, 32, 156, 90}
xa = {32, 54, 47, 76, 13}
print(ax.isdisjoint(xa))  # перевіряє чи пересікається хоть одне значення

# ax.update(xa)  # об'єднює множини
print(ax)

# ax.intersection_update(xa)  # пересікання
# ax.difference_update(xa)  # пересікання значень
print(ax)

ax.remove(444)  # не видалить і видасть помилку
ax.discart(444)  # якщо знайде - видалить, інакше помилки не буде
```
