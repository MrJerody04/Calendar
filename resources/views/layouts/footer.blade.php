</div>
<div style="background: black;color: white;text-align: center; padding: 25px;">
    &#169; {{ date('Y') }}
</div>
<script>
    var clicked = 0;
    function mobile_hamburger() {
        if(clicked == 0) {
            document.getElementById("mobile_nav").classList.add('flex');
            clicked = 1;
        }else{
            document.getElementById("mobile_nav").classList.remove('flex');
            clicked = 0;
        }
    }
</script>
</body>
</html>
