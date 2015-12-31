jQuery( document ).ready( function( $ ) {
	var menuContainer = $('.steped-nav'),
		searchField = $('.navbar-form .form-control'),
		searchParent = $('.navbar-form');

	$('.navbar-toggle').click(function() {
		menuContainer.toggleClass('menu-open');
	});

	searchField.focus(function() {
		searchParent.addClass("focused");
	});

	searchField.blur(function() {
		searchParent.removeClass("focused");
	});

	$('#carousel-logos').carousel({
	  interval: 4000
	})

	$('.carousel .item').each(function(){
	  var next = $(this).next();
	  if (!next.length) {
	    next = $(this).siblings(':first');
	  }
	  next.children(':first-child').clone().appendTo($(this));
	  
	  for (var i=0;i<1;i++) {
	    next=next.next();
	    if (!next.length) {
	    	next = $(this).siblings(':first');
	  	}
	    
	    next.children(':first-child').clone().appendTo($(this));
	  }
	});
	var getQueryVariable = function(variable){
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       var varsLength = vars.length;
	       var variables = "";
	       var variablesPrint = "";
	       for (var i=0;i<varsLength;i++) {
	            var pair = vars[i].split("=");
	               if(pair[0] == variable){
	               		variables = pair[1].split("+");
	            }
	       }
	       var variablesLength = variables.length;
	       for (var i=0;i<variablesLength;i++) {
	       		variablesPrint += '<span>' + variables[i] + '</span>';
	       }
	       $('.search-query').append(variablesPrint);
	       return(false);
	}
	getQueryVariable('s');
});


