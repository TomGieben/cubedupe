<script>
        document.getElementById("body").addEventListener("keydown", check);

        objImage = document.getElementById("imagechar");

         function check(e) {
            var key_code = e.which || e.keyCode;
                switch (key_code) {
                case 37: //left arrow key
                    moveLeft();
                    break;
                case 38: //Up arrow key
                    moveUp();
                    break;
                case 39: //right arrow key
                    moveRight();
                    break;
                case 40: //down arrow key
                    moveDown();
                    break;
                }

                objImage.scrollIntoView({
                    behavior: 'auto',
                    block: 'center',
                    inline: 'center'
                });
          }

        function moveLeft() {
            objImage.style.left = parseInt(objImage.style.left) - 20 + "px";
        }
        function moveUp() {
            objImage.style.top = parseInt(objImage.style.top) - 20 + "px";
        }
        function moveRight() {
            objImage.style.left = parseInt(objImage.style.left) + 20 + "px";
        }
        function moveDown() {
            objImage.style.top = parseInt(objImage.style.top) + 20 + "px";
        }

</script>