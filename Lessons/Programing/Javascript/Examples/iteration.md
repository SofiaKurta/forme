### JavaScript, Modulus Operator: Do something every nth iteration in a For Loop
```
var itemString = '<ul>';
for (var i = 0; i < result.feed.entries.length; i++){
	console.log(entry);
	var entry = result.feed.entries[i];

	// GOOD EXAMPLE OF HOW TO USE MODULUS OPERATOR TO DO SOMETHING EVERY NTH ITERATION

	if(i % 3 === 2){ // EVERY 3RD ITEM SHOULD CLOSE UL AND START A NEW ONE
		itemString += '<li>'+entry.title+'</li></ul><ul>';
	}else{
		itemString += '<li>'+entry.title+'</li>';
	}
}
$('#test').append(itemString);
```