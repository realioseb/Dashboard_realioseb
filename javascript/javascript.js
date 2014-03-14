$(document).ready(function(){
    /*
     * The best drag and drop by ioseb bichinashvili
     * Collaborator ioseb dzmanashvili
     * 
     * @drag
     */
    $(document).on("mousedown", ".widget-header", function() {
        /*
         * mx aris mausis x koordinati (Mouse X)
         * my aris mausis y koordinati (Mouse Y)
         */
        var $mx = event.pageX;
        var $my = event.pageY;
        
        if(typeof($mx) === "undefined" || typeof($my) === "undefined") {
            $mx = $(document).scrollLeft() + $(window).width() - 1;
            $my = $(document).scrollTop() + $(window).height() - 1;
        }
        
        /*
         * davitriet sachiro elementi
         */
        var $widget = document.elementFromPoint($mx, $my);
        $widget = $($widget).parents(".widget");
        
        /*
         * elementis koordinatebi
         * ex aris elementis x koordinati (element X)
         * ey aris elementis y koordinati (element Y)
         */
        var $offset = $($widget).offset();
        var $ex = $offset.left;
        var $ey = $offset.top;
        
        $(document).on("mousemove", $widget, function() {
            /*
             * mousemove-ma unda imushaos im shemtxvevashi tu monishnuli gvaqvs raime elementi
             */
            if(typeof($widget) !== "undefined" && $widget !== null) {
                /*
                 * ganvsazgvrot mausis cvlileba
                 */
                var $newMX = event.pageX - $mx;
                var $newMY = event.pageY - $my;

                /*
                 * ganvsazgvrot elementis poziciis cvlileba
                 */
                var $newEX = $ex + $newMX;
                var $newEY = $ey + $newMY;

                /*
                 * elementis poziciis shecvla
                 */
                $($widget).offset({ top: $newEY, left: $newEX });
            }
        });
        
        $(document).on("mouseup", $widget, function() {
            /*
             * datreuli vijetis xelidan dagdeba
             */
            $widget = null;
        });
    });
});
