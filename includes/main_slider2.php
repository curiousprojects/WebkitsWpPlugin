
<div class="" id="main-slider-2">
	<div class="row">
		<div class="col-xs-12 col-md-12 col-centered feature-col">
			<div class="row m-0">
				<?php echo $show; ?>


			</div>

		</div>
	</div>
</div>

<script>
    jQuery(function($){


        var myIndex = 0;
        var preIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("col-slider");
            myIndex = myIndex+6;
            for (i = 0; i < x.length; i++) {


                if(i < myIndex &&  i >= preIndex)
                {
                    x[i].style.display = "block";
                }
                else{
                    x[i].style.display = "none";
                }

            }

            preIndex = preIndex+6;
            if (myIndex >= 24) {
                myIndex = 0;
                preIndex = 0;

            }

            setTimeout(carousel, 10000); // Change image every 2 seconds
        }



    });


</script>