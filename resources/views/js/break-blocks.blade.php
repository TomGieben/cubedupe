@php

use App\Models\Block;
use App\Models\User;
use App\Models\World;

@endphp
<script>
        objImage = document.getElementById("imagechar");

    function changeBlock(block) {
        var dev = ("{{ config('app.dev') }}" ? true : false);
        var reachChar = {{ User::getVar('reach') }};
        var charPosY = objImage.getAttribute("data-grid-position-y");
        var charPosX = objImage.getAttribute("data-grid-position-x");

        var posY = block.getAttribute("data-grid-position-y")
        var posX = block.getAttribute("data-grid-position-x")

        if(Math.abs((posX - charPosX)) <= reachChar) {
            //destroys the block u are clicking and changing it to air
            if(block.getAttribute("data-block") != "air") {

                $.ajax({
                type:"POST",
                url: "{{ route('worlds.item') }}",
                data: {
                    _token : "{{ csrf_token() }}",
                    block : block.getAttribute("data-block"),
                    // item : 'pickaxe'
                    item : objImage.getAttribute("data-selected-item")
                },
                success: function(result){
                    var blockHp = block.getAttribute("data-hp");
                    if(dev) {
                        blockHp = (blockHp - 10000);
                    }else {
                        blockHp = (blockHp - result);
                    }

                    block.setAttribute("data-hp", blockHp);
                }});

                sleep(180).then(() => { 
                    if(block.getAttribute("data-hp") <= 0) {
                        block.setAttribute("data-block", "air");
                        block.setAttribute("data-damage", "0");
                        if(block.getAttribute("data-grid-position-y") > -1) {
                            block.style.backgroundColor = "#6ad2fd";
                        }else {
                            block.style.backgroundColor = "#736f6f";
                        }
                        checkBlock();
                    }
                });
            }

            //places a block if its an air block
            if(block.getAttribute("data-block") == "air") {
                        block.setAttribute("data-block", "wood");
                        block.setAttribute("data-damage", "0");
                        block.setAttribute("data-hp", "50");
                        block.style.backgroundColor = "#7c4307";
            }
        }
    }

    


</script>