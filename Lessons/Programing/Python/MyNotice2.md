```def func(x):
    def add(a):
        return x + a

    return add

test = func(40)
print(test(20))

def some_func():
    pass  # нічого не вертає

print(some_func())

# якщо к-сть параметрі не визначена
def dcc(*args):  # передаємо у вигляді списку
    return args

def ddc(**kwargs):  # передаємо у вигляді словаря
    return kwargs

print(dcc(2, 1, 4))
print(ddc(a=2, b='alo'))

add = lambda x, y: x + y

print(add(2, 5))
print((lambda x, y: x + y)(6, 6))

fufun = lambda *args: args

print(fufun(2, 3, 'John'))
####################################################################

# print(10/0)
# print(int('asd'))
# print('2' + 1)

# x = int(input())
# y = int(input())

# try:
#    res = x / y
# except ZeroDivisionError:
#    res = 0
# print(res)
####################################################################

# для виконання критичних операцій
# def ddaa(x, y):
#    return x + y

# with ddaa(10,0) as gr:
#    gr.__init__()


def decorator(funct):
    def wrapper():
        print("Before")
        funct()
        print("After")
    return wrapper

@decorator
def show():
    print('I\'m just a func')

# dec = decorator(show)

show()
```
