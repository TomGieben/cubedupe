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

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function updatePOV() {
            objImage.scrollIntoView({
                behavior: 'auto',
                block: 'center',
                inline: 'center'
            });
        }

        function moveLeft() {
            objImage.style.left = parseInt(objImage.style.left) - 20 + "px";
            updatePOV()
        }
        function moveUp() {
            objImage.style.top = parseInt(objImage.style.top) - 40 + "px";
            sleep(300).then(() => { objImage.style.top = parseInt(objImage.style.top) + 40 + "px"; });
            updatePOV()
        }
        function moveRight() {
            objImage.style.left = parseInt(objImage.style.left) + 20 + "px";
            updatePOV()
        }
        function moveDown() {
            objImage.style.top = parseInt(objImage.style.top) + 20 + "px";
            updatePOV()
        }

</script>