$(document).ready(function(){
	$("a#role").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#team").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#dept").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#dept_role_team").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#idc").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#idc_team").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#itsys").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#itsys_team").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#ip").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#iptype").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#itsys_ip").click(function(){
	  $("div#"+$(this).attr("id")).toggle();
    });
});

$(document).ready(function(){
	$("a#edit_submit").click(function(){
		$("form").submit();
	});
});