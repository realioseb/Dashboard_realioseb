<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Widgets-Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style/Style.css">
    </head>
    <body>
        <div class="navbar">
            სანავიგაციო ბარი (თუ დაგვჭირდება)
        </div>
        
        <section class="widget" draggable="true">
            <header class="widget-header">
                ვიჯეტის ჰედერი
                <form class="button-container" onmousedown="return false">
                    <button type="button" class="widget-header-button" title="edit">O</button>
                    <button type="button" class="widget-header-button" title="minimize">_</button>
                    <button type="button" class="widget-header-button" title="close">x</button>
                </form>
            </header>
            
            <section class="widget-content" onmousedown="return false">
                კონტენტი
            </section>
            
            <footer class="widget-footer" onmousedown="return false">
                და ფუტერი...
            </footer>
        </section>
        
    </body>
</html>