$(document).ready(function(){
    /*
     * The best drag and drop by ioseb bichinashvili
     * Collaborator ioseb dzmanashvili
     */
    $(document).on("mousedown", ".widget-header", function() {
        /*
         * mx aris mausis x koordinati (Mouse X)
         * my aris mausis y koordinati (Mouse Y)
         */
        var mx = event.pageX;
        var my = event.pageY;
        
        /*
         * davitriet sachiro elementi
         */
        var widget = document.elementFromPoint(mx, my).parentNode;
        
        /*
         * aviridot headershi arsebuli calkeuli elementebis monishvna
         */
        if(widget.className !== "widget") {
            unset(widget);
        }
        
        /*
         * elementis koordinatebi
         * ex aris elementis x koordinati (element X)
         * ey aris elementis y koordinati (element Y)
         */
        var ex = $(widget).offset().left;
        var ey = $(widget).offset().top;
        
        $(document).on("mousemove", widget, function() {
            /*
             * ganvsazgvrot mausis cvlileba
             */
            var newMX = event.pageX - mx;
            var newMY = event.pageY - my;

            /*
             * ganvsazgvrot elementis poziciis cvlileba
             */
            var newEX = ex + newMX;
            var newEY = ey + newMY;

            /*
             * vcvalot elementis pozicia
             */
            $(widget).offset({ top: newEY, left: newEX });
        });
        
        $(document).on("mouseup", widget, function() {
            widget = null;
        });
    });
});
