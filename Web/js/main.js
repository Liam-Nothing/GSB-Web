//Scroll func

window.onscroll = function() {scrollFunction();ne_loop_view_port();};
window.onload  = function() {scrollFunction();ne_loop_view_port();};

//********************************************************************************//

// When the user scrolls the page, execute scrollFunction 
function scrollFunction() {
	let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
	let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	let scrolled = (winScroll / height) * 100;
	document.documentElement.style.setProperty('--gototopPX-100', scrolled + "px");
	document.documentElement.style.setProperty('--gototop-100', scrolled + "");
	document.documentElement.style.setProperty('--gototop-X', winScroll + "");
	document.documentElement.style.setProperty('--gototopPR-X', winScroll + "%");
	// if(winScroll<800) {document.documentElement.style.setProperty('--gototopPR-X', winScroll + "%");}else{document.documentElement.style.setProperty('--gototopPR-X',"900%");}
	document.documentElement.style.setProperty('--gototopPR-100', scrolled + "%");
	if (scrolled == 0) {
		document.getElementById("header").classList.remove("scroll");
	}else{
		document.getElementById("header").classList.add("scroll");
	}
}
//********************************************************************************//

//Scrolling Css ViewPort
let ne_element_name = "ne-moving_element";
let lenght_list_items = document.getElementsByName(ne_element_name).length;
let i = 0;

function ne_loop_view_port() {
	for (i = 0; i < lenght_list_items; i++) {
		ne_view_port_test(i)
	}
}

function ne_view_port_test(i) {
	var target_element = document.getElementsByName(ne_element_name)[i];
	var bounding = target_element.getBoundingClientRect();

	if ((bounding.bottom-(bounding.height)+100) <= (window.innerHeight || document.documentElement.clientHeight)) {
		target_element.classList.add("ne-transition");
	} else if ( (bounding.bottom-bounding.height) > (window.innerHeight || document.documentElement.clientHeight))  {
		target_element.classList.remove("ne-transition");
	}
}
//********************************************************************************//


// ParticlesJS Config.
particlesJS("particles-js", {
	"particles": {
		"number": {
			"value": 80,
			"density": {
				"enable": true,
				"value_area": 700
			}
		},
		"color": {
			"value": "#ffffff"
		},
		"shape": {
			"type": "circle",
			"stroke": {
				"width": 0,
				"color": "#000000"
			},
			"polygon": {
				"nb_sides": 5
			},
		},
		"opacity": {
			"value": 0.5,
			"random": false,
			"anim": {
				"enable": false,
				"speed": 0.1,
				"opacity_min": 0.1,
				"sync": false
			}
		},
		"size": {
			"value": 3,
			"random": true,
			"anim": {
				"enable": false,
				"speed": 10,
				"size_min": 0.1,
				"sync": false
			}
		},
		"line_linked": {
			"enable": true,
			"distance": 150,
			"color": "#ffffff",
			"opacity": 0.4,
			"width": 1
		},
		"move": {
			"enable": true,
			"speed": 2,
			"direction": "none",
			"random": false,
			"straight": false,
			"out_mode": "out",
			"bounce": false,
			"attract": {
				"enable": false,
				"rotateX": 600,
				"rotateY": 1200
			}
		}
	},
	"interactivity": {
		"detect_on": "canvas",
		"events": {
			"onhover": {
				"enable": true,
				"mode": "grab"
			},
			"onclick": {
				"enable": false,
				"mode": "push"
			},
			"resize": true
		},
		"modes": {
			"grab": {
				"distance": 140,
				"line_linked": {
					"opacity": 1
				}
			},
			"bubble": {
				"distance": 400,
				"size": 40,
				"duration": 2,
				"opacity": 8,
				"speed": 3
			},
			"repulse": {
				"distance": 200,
				"duration": 0.4
			},
			"push": {
				"particles_nb": 4
			},
			"remove": {
				"particles_nb": 2
			}
		}
	},
	"retina_detect": true
});