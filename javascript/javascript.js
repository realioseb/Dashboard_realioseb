$(document).ready(function(){
    $(document).on("mousedown", ".widget-header", function() {
        /*
         * mx aris mausis x koordinati (Mouse X)
         * my aris mausis y koordinati (Mouse Y)
         */
        var mx = event.pageX;
        var my = event.pageY;
        
        /*
         * davitriet sachiro elementis koordinatebi:
         * ex aris elementis x koordinati (element X)
         * ey aris elementis y koordinati (element Y)
         */
        var widget = document.elementFromPoint(mx, my);
        
        var ex = $(widget).offset().left;
        var ey = $(widget).offset().top;
        
        $(document).on("mousemove", widget, function() {
            /*
             * ganvsazgvrot mausis cvlileba
             */
            var newMX = event.pageX - mx;
            var newMY = event.pageY - my;
            
            /*
             * migebuli a(NewMX, NewMY) veqtorit shevcvalot elementis pozicia
             */
            
        });
    });
});
