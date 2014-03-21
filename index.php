<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="dist/icons/favicon.ico">
            <title>Dashboard</title>
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/dashboard.css" rel="stylesheet">
        <link href="style/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard_realioseb</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Log in</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar dropdown-menu-left">
                        <li class="badge">group 1</li>
                        <li><a href="#">beautiful widget</a></li>
                        <li><a href="#">ugly one</a></li>
                        <li><a href="#">parser widget</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li class="badge">group 2</li>
                        <li><a href="">widget name</a></li>
                        <li><a href="">another widget</a></li>
                        <li><a href="">one more widget</a></li>
                        <li><a href="">and etc...</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li class="badge">group 3</li>
                        <li><a href="">news widget</a></li>
                        <li><a href="">something interesting</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="padding: 0">
                    <div class="col-lg-1 droppable"">
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
                    <div class="col-lg-1 droppable">
                        
                    </div>
                    <div class="col-lg-1 droppable">
                        
                    </div>
                </div>
            </div>
        </div>
        
        <script src="javascript/jquery-1.10.2.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="dist/js/docs.min.js"></script>
        <script src="javascript/javascript.js"></script>
    </body>
</html>