<div>
    <style>
        .mySlides {
            display:none
        }
        .w3-badge {
            height:13px;
            width:13px;
            padding:0
        }
    </style>
    <div class="w3-display-container bg-white d-flex flex-wrap justify-content-center border-bottom slide">
        @foreach($slideshows as $image)
            @php
                $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                $url = $disk->url($image->image);
            @endphp
            <img class="mySlides" src="{{ $url }}">
        @endforeach
        <div class="w3-center w3-container w3-section w3-large w3-display-bottommiddle" style="width:100%">
            <div class="w3-left w3-hover-text-khaki pointer" onclick="plusDivs(-1)">&#10094;</div>
            <div class="w3-right w3-hover-text-khaki pointer" onclick="plusDivs(1)">&#10095;</div>
            @for($i = 1;$i <= count($slideshows);$i++)
                <span class="w3-badge demo w3-border w3-transparent w3-hover-gray pointer" onclick="currentDiv({{ $i }})"></span>
            @endfor
        </div>
    </div>
    <script>
        var slideIndex = 1;
        let count = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            count = n;
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-black", "");
            }
            x[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " w3-black";
        }

        let totalImage = $(".demo").length;

        setInterval(function (){
            count++;
            currentDiv(count)
            if(count > totalImage) count = 1;
        },5000)
    </script>
</div>
