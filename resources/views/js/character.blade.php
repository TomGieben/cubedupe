@php

    use App\Models\Block;
    use App\Models\User;
    use App\Models\World;

@endphp
<script>
    document.getElementById("body").addEventListener("keydown", check);

    objImage = document.getElementById("imagechar");

    var lastTimeS = 0;

    //checks if a button is pressed
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
                checkBlock();
                break;
            case 32: //space bar
                var nowS = new Date().getTime(); // Time in milliseconds
                if (nowS - lastTimeS < 500) {
                    return;
                } else {
                    lastTimeS = nowS;
                }
                moveUp();
                break;
        }
    }


    var lastTime = 0;
    var blockWidth = {{ Block::getVar('width') }}
    var blockHeight = {{ Block::getVar('height') }}

    var charWidth = {{ User::getVar('width') }}
    var charHeight = {{ User::getVar('height') }}

    var worldPositiveY = {{ World::getVar('positiveY') }}
    var worldNegativeY = {{ World::getVar('negativeY') }}
    var worldPositiveX = {{ World::getVar('positiveX') }}

    //updates the screen to the middle of the char
    function updatePOV() {
        objImage.scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center'
        });
    }

    //waits x ms untill it reads again
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    $("#imagechar").click(function() {
        $.ajax({
            type: "POST",
            url: "{{ route('worlds.update') }}",
            data: {
                _token: "{{ csrf_token() }}",
                html: $("#save").html()
            },
            success: function(result) {
                console.log(result);
            }
        });
    });

    //checks block type under char
    function checkBlock() {
        var charPosX = objImage.getAttribute("data-grid-position-x");
        var charPosY = objImage.getAttribute("data-grid-position-y");
        var blockPosX = charPosX;
        var blockPosY = (charPosY - 1);
        var block;

        var yElements = document.querySelectorAll('[data-grid-position-x="' + blockPosX + '"]');
        yElements.forEach(element => {
            if (element.getAttribute("data-grid-position-y") == blockPosY) {
                block = element.getAttribute("data-block");

                if (block == "air") {
                    moveDown();
                }
            }
        });
    }

    //changes attribute depending on the grid-position
    function changePos(dir) {
        if (dir == "L") {
            var charPosX = objImage.getAttribute("data-grid-position-x");
            charPosX = (charPosX - 1);

            objImage.setAttribute("data-grid-position-x", charPosX);
        }

        if (dir == "R") {
            var charPosX = objImage.getAttribute("data-grid-position-x");
            charPosX++;

            objImage.setAttribute("data-grid-position-x", charPosX);
        }

        if (dir == "D") {
            var charPosY = objImage.getAttribute("data-grid-position-y");
            charPosY = (charPosY - 1);

            objImage.setAttribute("data-grid-position-y", charPosY);
        }
        checkBlock();
    }

    //moves char to the left
    function moveLeft() {
        if ((objImage.getAttribute("data-grid-position-x") - 1) != 0) {
            changePos("L");

            objImage.style.left = parseInt(objImage.style.left) - blockWidth + "px";
            updatePOV()
        }
    }

    //lets the char jump 2 block high
    function moveUp() {
        objImage.style.top = parseInt(objImage.style.top) - (blockHeight * 2) + "px";
        sleep(300).then(() => {
            objImage.style.top = parseInt(objImage.style.top) + (blockHeight * 2) + "px";
        });
        updatePOV()
    }

    //moves char 1 block right
    function moveRight() {
        if (objImage.getAttribute("data-grid-position-x") != worldPositiveX) {
            changePos("R");

            objImage.style.left = parseInt(objImage.style.left) + blockWidth + "px";
            updatePOV()
        }
    }

    //moves char down
    function moveDown() {
        changePos("D");

        objImage.style.top = parseInt(objImage.style.top) + blockHeight + "px";
        updatePOV()
    }

    //onload do these functions
    window.addEventListener('load', function() {
        checkBlock();

        objImage.scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center'
        });
    })
</script>
