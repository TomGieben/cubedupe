@php

use App\Models\Block;

@endphp
<script>
    document.getElementById("body").addEventListener("keydown", check);

    objImage = document.getElementById("imagechar");

    var lastTime = 0;
    var blockWidth = {{ Block::getVar('width') }}
    var blockHeight = {{ Block::getVar('height') }}

    function check(e) {
        var key_code = e.which || e.keyCode;
        switch (key_code) {
            case 37: //left arrow key
                moveLeft();
                break;
            case 39: //right arrow key
                moveRight();
                break;
            case 40: //down arrow key
                moveDown();
                break;
            case 32: //space bar
                var now = new Date().getTime(); // Time in milliseconds
                if (now - lastTime < 1000) {
                    return;
                } else {
                    lastTime = now;
                }
                moveUp();
                break;
        }

        objImage.scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center'
        });
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function moveLeft() {
        objImage.style.left = parseInt(objImage.style.left) - blockWidth + "px";
    }

    function moveUp() {
        objImage.style.top = parseInt(objImage.style.top) - (blockHeight * 2) + "px";
        sleep(500).then(() => {
            objImage.style.top = parseInt(objImage.style.top) + (blockHeight * 2) + "px";
        });
    }

    function moveRight() {
        objImage.style.left = parseInt(objImage.style.left) + blockWidth + "px";
    }

    function moveDown() {
        objImage.style.top = parseInt(objImage.style.top) + blockHeight + "px";
    }
</script>
