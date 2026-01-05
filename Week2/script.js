const form = document.getElementById('contact_form');

form.addEventListener("submit", function(e){
	e.preventDefault();

	const input = document.getElementsByClassName('input');
	const message = document.getElementsByClassName('message');
	const msg_sent = document.getElementById('msg_sent');

	message[0].innerText = "";
	message[1].innerText = "";
	message[2].innerText = "";
	msg_sent.innerText = "";

	if (input[0].value === ""){
		message[0].innerText = "Mail cannot be empty";
		message[0].style.color = "red";
	}
	else if(input[1].value === ""){
		message[1].innerText = "Number cannot be empty";
		message[1].style.color = "red";
	}
	else if(input[2].value === ""){
		message[2].innerText = "Message cannot be empty";
		message[2].style.color = "red";
	}
	else{
		msg_sent.innerText = "Form submitted successfully!";
		msg_sent.style.color = "green";
		
		form.reset();
	}
	
})