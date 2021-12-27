<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-content w3-display-container" style="max-width:100%">
<?php
	$get_slider = $product->show_slider();
	if($get_slider){
		while($result_slider = $get_slider->fetch_assoc()){

	 ?>
	<img class="mySlides" src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>" style="width:100%"/>
	<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
		<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
	<?php
		}
	}
?>
</div>

<script>
var myIndex = 0;
var slideIndex = 1;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000); // Change image every 2 seconds
}

showDivs(slideIndex);
function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>