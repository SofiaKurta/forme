```
var somearr = ['bla1','bla2','bla3','bla4','bla5','bla6','bla7','bla8','bla9'];

    if (somearr.length % 3 === 0){
        var arr = [];
        var step = 0;
        var lang = 0;
        for(var i = 0; i < somearr.length; i++){
            if(i === 0) arr[step] = [];

            arr[step][lang] = somearr[i]; lang++;

            if(i % 3 === 2){
                step++; lang=0;
                if((somearr.length - 1) !== i) arr[step] = [];
            }
        }
        console.log(arr);
    }
```
http://dle-net.ru/index.php?newsid=803
http://newtemplates.ru/food/
