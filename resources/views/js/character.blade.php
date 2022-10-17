@php

use App\Models\Block;
use App\Models\User;

@endphp
<script>
        document.getElementById("body").addEventListener("keydown", check);

        objImage = document.getElementById("imagechar");

        var lastTime = 0;

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
                    if (now - lastTime < 500) {
                        return;
                    } else {
                        lastTime = now;
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

        function updatePOV() {
            objImage.scrollIntoView({
                behavior: 'auto',
                block: 'center',
                inline: 'center'
            });
        }


        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function checkBlock()
        {
            var charPosX = objImage.getAttribute("data-grid-position-x");
            var charPosY = objImage.getAttribute("data-grid-position-y");
            var blockPosX = charPosX;
            var blockPosY = (charPosY - 1);

            var yElements = document.querySelectorAll('[data-grid-position-x="'+blockPosX+'"]');
            yElements.forEach(element => {
                if(element.getAttribute("data-grid-position-y") == blockPosY)
                {
                    console.log(element);
                }
            });

            // if (charHeight > blockPosY && charPosY < blockHeight && charWidth > blockPosX && charPosX < blockWidth) {
            //     if(!air){

            //     }
            // }
        }

        function changePos(dir)
        {
            checkBlock();

            if(dir == "L")
            {
                var charPosX = objImage.getAttribute("data-grid-position-x");
                charPosX = (charPosX - 1);

                objImage.setAttribute("data-grid-position-x", charPosX);
            }

            if(dir == "R")
            {
                var charPosX = objImage.getAttribute("data-grid-position-x");
                charPosX++;

                objImage.setAttribute("data-grid-position-x", charPosX);
            }

            if(dir == "D")
            {
                var charPosY = objImage.getAttribute("data-grid-position-y");
                charPosY = (charPosY - 1);

                objImage.setAttribute("data-grid-position-y", charPosY);
            }
        }

        function moveLeft() {
            changePos("L");

            objImage.style.left = parseInt(objImage.style.left) - blockWidth + "px";
            updatePOV()
        }
        function moveUp() {
            objImage.style.top = parseInt(objImage.style.top) - (blockHeight * 2) + "px";
            sleep(300).then(() => { objImage.style.top = parseInt(objImage.style.top) + 40 + "px"; });
            updatePOV()
        }
        function moveRight() {
            changePos("R");

            objImage.style.left = parseInt(objImage.style.left) + blockWidth + "px";
            updatePOV()
        }
        function moveDown() {
            changePos("D");

            objImage.style.top = parseInt(objImage.style.top) + blockHeight + "px";
            updatePOV()
        }    

        window.addEventListener('load', function () {
            objImage.scrollIntoView({
                behavior: 'auto',
                block: 'center',
                inline: 'center'
            });
        })
  
</script>
