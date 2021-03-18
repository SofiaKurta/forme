## SQL
Cпершу я би модифікував текстові поля ```asin``` в обох таблицях: ```t1, t2``` \
Якщо я правильно зрозумів поле ```asin``` - це артикул товару, тому змінив тип ```text (65536 симв.)``` на ```varchar(10)```. Це зекономить нам пам'ять в обох табличках ```t1, t2```. Не дивлячись на те, артикул займає лише 5 символів, все одно буде виділятися пам'ять під 65536 символів.
```sql 
ALTER TABLE t1 MODIFY asin VARCHAR(10) NULL; 
ALTER TABLE t2 MODIFY asin VARCHAR(10) NULL;
```

**1 завдання**
```sql
SELECT id_region, price, title FROM t1 INNER JOIN t2 on t1.asin = t2.asin;
```

**2 завдання** \
В табличці ```t2``` потрібно створити UNIQUE INDEX для уникнення повторювань (наскільки я зрозумів ```title``` може бути тільки один) і ще нам потрібен індекс, щоб JOIN'ти дві таблички по полям ```asin```. Пошук буде відбуватися по полю ```asin``` в таблиці ```t2```. \
\
Використовувати буду INNER JOIN оскільки нам потрібні ті записи, які відповідають умові: ```t1.asin = t2.asin```. \
У випадку з LEFT JOIN ми отримаємо NULL у полі ```title```, якщо умова не буде виконана та й операція з LEFT JOIN створить більше навантажуватиме на ЦП.
```sql
CREATE UNIQUE INDEX asin_index ON t2(asin);
```

**3 завдання**
```sql
SELECT t2.title FROM t1
    JOIN t2 on t1.asin = t2.asin
    GROUP BY t2.title
    HAVING COUNT(t1.price) > 1;
```
або
```sql
SELECT title FROM t2 
    WHERE asin IN (SELECT asin FROM t1 GROUP BY asin HAVING COUNT(price) > 1);
```
**4 завдання** \
Виконувати DELETE або TRUNCATE тут вже залежить від задачі. \
TRUNCATE, наприклад, не ресурсномістка задача, швидко почистить табличку від усіх даних, обнулить лічильньк AUTO_INCREMENT і неможливо буде відкоити(rollback) зміни. \
DELETE не обнулить лічильник AUTO_INCREMENT, видаляє по критерію WHERE або без нього, можливий відкат.

## PHP

**1 завдання**
```php
$a = [1,2,3,4,5,6,7];
$b = [1,2,3,4,5,6,7,8,9];

function arrayAlignment(array $arrayA, array $arrayB): array
{
    return count($arrayA) > count($arrayB)
        ? array_slice($arrayA, 0, count($arrayB))
        : array_slice($arrayB, 0, count($arrayA));
}

echo print_r(arrayAlignment($b, $a), true);
//return: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 )
```

**2 завдання**
```php
$arr = [0 => 'a', 1 => 'c', 2 => 'f', 3 => 'd', 4 => 'b', 5 => 'e'];
sort($arr, SORT_STRING);
echo print_r($arr, true);
//return: Array ( [0] => a [1] => b [2] => c [3] => d [4] => e [5] => f )
```


**3 завдання** \
*просте рішення:* 
```php
$url = 'http://localhost/users?param=a&sort=1';
$postfix = json_encode([ 'filter_name' => 'іван', 'age' => 32, 'filter_param' => '!@#$%^&*()_+~`' ]);
$query = parse_url($url, PHP_URL_QUERY);

$url .= (parse_url($url, PHP_URL_QUERY) ? '&' : '?') . http_build_query(json_decode($postfix, true));
//return: http://localhost/users?param=a&sort=1&filter_name=%D1%96%D0%B2%D0%B0%D0%BD&age=32&filter_param=%21%40%23%24%25%5E%26%2A%28%29_%2B%7E%60
```
*складніше рішення:* 
```php
$url = 'http://localhost/users?param=a&sort=1';
$postfix = json_encode([ 'filter_name' => 'іван', 'age' => 32, 'filter_param' => '!@#$%^&*()_+~`' ]);
$url = new URL($url);
$url->appendParamsFromJson($postfix)->build();
//return: http://localhost/users?param=a&sort=1&filter_name=%D1%96%D0%B2%D0%B0%D0%BD&age=32&filter_param=%21%40%23%24%25%5E%26%2A%28%29_%2B%7E%60

class URL {

    private $scheme;
    private $host;
    private $path;
    private $params = [];

    public function __construct(string $url)
    {
        $this->parseUrl($url);
    }

    private function parseUrl(string $url): void
    {
        $parts = parse_url($url);
        $this->scheme = $parts['scheme'] ?? 'http';
        $this->host = $parts['host'] ?? 'localhost';
        $this->path = $parts['path'];

        if(isset($parts['query'])){
            parse_str($parts['query'], $this->params);
        }
    }

    public function build(): string
    {
        return $this->scheme
            . '://' . $this->host
            . (!empty($this->path) ? $this->path : '')
            . (!empty($this->params) ? '?' . http_build_query($this->params) : '');
    }

    public function appendParamsFromJson(string $jsonParams): URL
    {
        $parametersArray = json_decode($jsonParams, true);
        $this->appendParams($parametersArray);
        return $this;
    }

    public function appendParams(array $params): URL
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }

}

function dd($arg)
{
    echo "<pre>"; var_dump($arg); exit("</pre>");
}

```

**4 завдання**
```php
$url="http://nginx/action.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER [ "HTTP_USER_AGENT" ]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 150);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
$content = curl_exec($ch);
curl_close($ch);
```
