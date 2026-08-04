let books = [{
	title: "Let the Right One In",
	author: "John Ajvide Lindqvist",
	published: 2005
}; //quoted kyes are optional in JS, but recommended for consistency

{
	title: "Retun of the King",
	author: "J.R.R. Tolkien",
	published: 1955
}; 
];
//use the . syntax to access the property of the book variable	
console.log(book.title);
console.log(book.author);
console.log(book.published);

console.log(book);

console.table(book);

for (property in book) {
	document.getElementById("book").innerHTML += "<p>" + property + ": " + book[property] + "</p>";
}