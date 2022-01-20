require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function(){

	// allow/remove user access
	$('.button_disable').click(function(){
		var self = $(this);
		axios.post($(this).data('url'))
			.then(function(response) {
				if(response.data == 'detached'){
					Swal.fire({
						icon: 'success',
						title: 'Done',
						text: 'You just remove an access permission ',
						showConfirmButton: false,
						timer: 1000
					});
					self.removeClass('btn-success');
					self.addClass('btn-danger');
					self.text('Enable');
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: 'You just give an access permission ',
						showConfirmButton: false,
						timer: 1000
					});
					self.removeClass('btn-danger');
					self.addClass('btn-success');
					self.text('Disable');
				}

			});
	});

});