$(document).ready(function () {
	preventFormResubmit();
	limitDescription();
	/*addActive();*/
	applyModal();
	changeApplyBtnText();

	function preventFormResubmit() {
		if ( window.history.replaceState ) {
        	window.history.replaceState( null, null, window.location.href );
    	}
	};

	function limitDescription() {
		$(".jobsearch-container .description").text(function(index, currentText) {
		    return currentText.substr(0, 175) + '...';
		});
	}

	/*function addActive() {
		$('.readmore-btn').click(function() {
			if($(this).hasClass('active')) {
				$(this).removeClass('active');
			} else {
				$(this).addClass('active');
			}
		});
	}*/

	function applyModal() {
		// Get the modal
		var modal = document.getElementById('modal-container');

		var btn = document.getElementById("readmore-modal");

		var close = document.getElementsByClassName("close-btn")[0];

		$(btn).click(function() {
			$(modal).css({"opacity":"1", "visibility":"visible", "transition":"ease 1s"});
		});

		$(close).click(function() {
			$(modal).css({"opacity":"0", "visibility":"hidden"});
		});

		$(window).click(function(event) {
			if(event.target == modal) {
				$(modal).css({"opacity":"0", "visibility":"hidden"});
			}
			
		});
	}

	function changeApplyBtnText() {
		if ($('.apply-btn').prop('disabled') == true) {
			$('.apply-btn').val('Applied');
		}
	}
});