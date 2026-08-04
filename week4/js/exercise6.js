let pics = ["img00.jpg", "img01.jpg", "img02.jpg"];

for (let i = 0; i < pics.length; i++) {
			document.getElementById("pics").innerHTML += "<img src=images/" + pics[i] + " alt='Image " + i + "'>";
		}