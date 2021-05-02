<!doctype html>
<html lang="en">
<head>
    <title>I-VEE : Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="library\jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/root.css?version=51">
    <link rel="stylesheet" href="css/index.css?version=51">


</head>
<body class="bg-light">

    <div class="container-fluid position-fixed mynav">
        <div class="row mx-3">
            <div class="col-md-6 mt-3 text-white">
                I-VEE
            </div>
            <div class="col-md-6 mt-3">
                <ul style="list-style: none; float: right;">
                    <li class="d-inline-block mx-2"><a href="index.php" class="header-link" data-content="HOME" rel="popover" data-placement="bottom" data-trigger="hover"><i class="fas fa-home bg-white text-dark header-icon"></i></a></li>
                    <li class="d-inline-block mx-2"><a href="harga.php" class="header-link" data-content="PRICE TABLE" rel="popover" data-placement="bottom" data-trigger="hover"><i class="fas fa-dollar-sign bg-white text-dark header-icon"></i></a></li>
                    <li class="d-inline-block mx-2"><a href="forecast.php" class="header-link" data-content="FORECASTING" rel="popover" data-placement="bottom" data-trigger="hover"><i class="fas fa-chart-line bg-white text-dark header-icon"></i></a></li>
                    <li class="d-inline-block ml-2"><a href="#" class="header-link" data-content="ABOUT US" rel="popover" data-placement="bottom" data-trigger="hover"><i class="fas fa-info bg-white text-dark header-icon"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row header">
            <div class="col-md-12 text-center my-auto text-white">
                <H1>HOME</H1>
                <p class="h5">Cari tahu harga daging dulu, sekarang dan di masa yang akan datang</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-5 text-center bg-white">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <i class="fas fa-dollar-sign fa-10x mb-3 text-success"></i>
                        <h4 class="card-title">CURRENT PRICE</h4>
                        <p class="card-text">See current market prices for livestock products with a single tap</p>
                        <a href="harga.php" class="btn btn-success rounded w-100">SEE IN HERE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5 text-center bg-white">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-10x mb-3 text-success"></i>
                        <h4 class="card-title">FORECASTING</h4>
                        <p class="card-text">Prepare yourself for economic competition by predicting the price  of livestock products</p>
                        <a href="forecast.php" class="btn btn-success rounded w-100">FORECAST NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 100vh;"></div>


    <script>
        $(".header-link").popover();

        $(window).scroll(function() {
            $(".mynav").toggleClass("mynav-scrolled", $(this).scrollTop() > 500);
        });
    </script>
</body>
</html>