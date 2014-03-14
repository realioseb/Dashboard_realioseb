<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style/Style.css">
    </head>
    <body>
        <div class="navbar">
            სანავიგაციო ბარი (თუ დაგვჭირდება)
        </div>
        
        <div class="column">
            <section class="widget">
                <header class="widget-header" onmouseup="return false">
                    <h1>ვიჯეტის ჰედერი</h1>
                    <form class="button-container">
                        <button type="button" class="widget-header-button" title="edit">O</button>
                        <button type="button" class="widget-header-button" title="minimize">_</button>
                        <button type="button" class="widget-header-button" title="close">x</button>
                    </form>
                </header>

                <section class="widget-content">
                    კონტენტი
                </section>

                <footer class="widget-footer">
                    და ფუტერი...
                </footer>
            </section>
        </div>
        <div class="column" id="test">
            
        </div>
        <script src="javascript/jquery-1.10.2.min.js"></script>
        <script src="javascript/javascript.js"></script>
    </body>
</html>