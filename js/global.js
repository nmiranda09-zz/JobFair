$(document).ready(function () {
	$(".loader-container").fadeOut("slow");

	preventFormResubmit();
	limitDescription();
	addActive();
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
		$(".jobsearch-index .description").text(function(index, currentText) {
		    return currentText.substr(0, 175) + '...';
		});
	}

	function addActive() {
		$('.menu-container, .account-index .left-column > h3').click(function() {
			if($(this).parent().hasClass('active')) {
				$(this).parent().removeClass('active');
			} else {
				$(this).parent().addClass('active');
			}
		});
	}

	function applyModal() {
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
		var modal = document.getElementById('zoom_modal_ontainer');
		var img = document.getElementById('msg_img');
		var modalImg = document.getElementById("img_zoom");

		$(img).click(function() {
			$(this).css('display', 'block');
			modalImg.src = this.src;
		    captionText.innerHTML = this.alt;
		});

		var span = document.getElementsByClassName("close")[0];

		$(span).click(function() { 
		  $(this).css('display', 'none');
		});
	}
});