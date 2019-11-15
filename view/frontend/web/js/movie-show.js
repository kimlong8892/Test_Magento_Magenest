require(['jquery'], function($){
    $(document).ready(function () {
        var size = 30;
        setInterval(function () {
            var color = ['red', 'blue', 'green', 'yellow', 'violet'];
            var rand = Math.floor(Math.random() * color.length - 1) + 0;
            size += 5;
            $("#title").css({'color': color[rand], 'font-size':size+"px"});
            if(size >= 60)
                size = 30;
        }, 1000);
    });
})