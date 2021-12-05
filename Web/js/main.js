//Scrolling Css ViewPort
var ne_element_name = "ne-moving_element";
var lenght_list_items = document.getElementsByName(ne_element_name).length;
var i = 0;

setTimeout(ne_loop_view_port, 10)

function ne_loop_view_port() {
	for (i = 0; i < lenght_list_items; i++) {
		ne_view_port_test(i)
	}
	setTimeout(ne_loop_view_port, 10)
}

function ne_view_port_test(i) {

	var target_element = document.getElementsByName(ne_element_name)[i];
	var bounding = target_element.getBoundingClientRect();

	if ((bounding.bottom-(bounding.height/2)) <= (window.innerHeight || document.documentElement.clientHeight)) {

		//console.log('OK : ' + i);
		target_element.classList.add("ne-transition");
	} else if ( (bounding.bottom-bounding.height) > (window.innerHeight || document.documentElement.clientHeight))  {
		target_element.classList.remove("ne-transition");
	}
}

// When the user scrolls the page, execute scrollFunction 
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}