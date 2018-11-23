$(document).ready(function () {
	$(".loader-container").fadeOut("slow");

	preventFormResubmit();
	limitDescription();
	/*addActive();*/
	applyModal();
	changeApplyBtnText();
	openTabs();
	imgZoomModal();

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

	function openTabs() {
		$(".tab-list").on("click", ".tab", function(e) {
			e.preventDefault();
			
			$(".tab").removeClass("active");
			
			$(".tab-content").removeClass("show");
			
			$(this).addClass("active");
			$($(this).attr("href")).addClass("show");
		});
	}

	function imgZoomModal() {
		// Get the modal
		var modal = document.getElementById('zoom_modal_ontainer');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('msg_img');
		var modalImg = document.getElementById("img_zoom");
		
		img.onclick = function(){
		    modal.style.display = "block";
		    modalImg.src = this.src;
		    captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
		  modal.style.display = "none";
		}
	}
});