import swal from "sweetalert2";

class Confirmation {
	static confirm(text, title = "Are you sure") {
		return new Promise((resolve, reject) => {
			swal({
				title: title,
				html: text,
				type: "question",
				showCancelButton: true,
				confirmButtonText: " Yes !",
				cancelButtonText: "No, cancel!",
				confirmButtonClass: "btn btn-primary",
				cancelButtonClass: "btn btn-danger",
				buttonsStyling: false
			}).then(
				() => resolve(),
				error => {
					if (!reject) {
						reject(error);
					}
				}
			);
		});
	}
	static info(text, title = "Are you sure",type='info') {
		swal({
			title: title,
			html: text,
			type: type
			// showCancelButton: false,
			// confirmButtonText: ' Okay!',
			// cancelButtonText: 'No, cancel!',
			// confirmButtonClass: 'btn btn-primary',
			// buttonsStyling: false
		});
	}
}

export default Confirmation;
