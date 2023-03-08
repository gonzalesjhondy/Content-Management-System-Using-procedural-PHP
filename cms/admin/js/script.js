// tinymce.init({selector:'textarea'});

$(document).ready(function(){

	$('#selectAllBoxes').click(function(event){

      if(this.checked) {

      $('.checkBoxes').each(function(){

          this.checked = true;

      });

      } else {


        $('.checkBoxes').each(function(){

          this.checked = false;

        });


        }

 });
 
//for lodaer lecture 212
 var div_box = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(div_box); 
//target the load screen
$('#load-screen').delay(700).fadeOut(600, function(){
  $(this).remove();
});
//for lodaer lecture 212




});
//lecture 226 userOnline
function loadUsersOnline(){

    $.get("functions.php?onlineusers=result", function(data){

      $(".userOnline").text(data);


    });

}

setInterval(function(){

  loadUsersOnline();

},500);//lecture 226 userOnline

