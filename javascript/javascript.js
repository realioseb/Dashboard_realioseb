/*
 * gadaecema html-s objecti
 * abrunebs mis zeda marcxena da qveda marjvena wertilis koordinatebs
 */
function elemPosition(elem)
{
    var offset = elem.offset();
    var top = offset.top;
    var left = offset.left;
    
    var bottom = $(elem).height() + top;
    var right = $(elem).width() + left;
    
    return {top: top, left: left, bottom: bottom, right: right};
}

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
        var $mx = $(document).scrollLeft() + event.clientX - 1;
        var $my = $(document).scrollTop() + event.clientY - 1;
        
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
                var $newMX = $(document).scrollLeft() + event.clientX - 1 - $mx;
                var $newMY = $(document).scrollLeft() + event.clientY - 1 - $my;
                
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
            
            var $mouseX = $(document).scrollLeft() + event.clientX - 1;
            var $mouseY = $(document).scrollLeft() + event.clientY - 1;
            
            /*
             * avigot is sveti romelshic motavsebulia kursori
             * da chavsvat vijetis
             */
            var $column;
            $(".droppable").each(function() {
                var coord = elemPosition($(this));
                if ($mouseX > coord.left && $mouseX <= coord.right) {
                    if ($mouseY < coord.bottom && $mouseY >= coord.top) {
                        $column = this;
                    }
                }
            });
            
            $($column).append($widget);
            $($widget).css({top: 0, left: 0});
            
            
            /*
             * datreuli vijetis xelidan dagdeba
             */
            $widget = null;
        });
    });
});
