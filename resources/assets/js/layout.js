let path= window.location.href;

let links= document.querySelectorAll(".navbar .nav-item .nav-link");

links.forEach((link)=>{
	if(link.href==path){
		link.setAttribute("class", link.getAttribute("class")+ " active");
	}

});