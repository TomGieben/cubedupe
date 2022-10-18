@php

use App\Models\Block;
use App\Models\User;
use App\Models\World;

@endphp
<script>
        objImage = document.getElementById("imagechar");

    function breakBlock(block) {
        var dev = ("{{ config('app.dev') }}" ? true : false);
        var reachChar = {{ User::getVar('reach') }};
        var charPosY = objImage.getAttribute("data-grid-position-y");
        var charPosX = objImage.getAttribute("data-grid-position-x");

        var posY = block.getAttribute("data-grid-position-y")
        var posX = block.getAttribute("data-grid-position-x")

        if(Math.abs((posX - charPosX)) <= reachChar){
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
                    if(block.getAttribute("data-hp") <= 0){
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
        }
    }

    


</script>