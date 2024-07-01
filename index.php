<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact US</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <style type="text/css">
        /* body {
            padding-top: 60px;
            padding-bottom: 40px;
        } */

        /* .navbar-brand img {
            margin-top: -5px;
            margin-right: auto;
            margin-left: auto;
        } */


        body {
            background-color: #25274d;
        }

        .contact {
            padding: 4%;
            height: 400px;
        }

        .col-md-3 {
            background: #ff9b00;
            padding: 4%;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .contact-info {
            margin-top: 10%;
        }

        .contact-info img {
            margin-bottom: 15%;
        }

        .contact-info h2 {
            margin-bottom: 10%;
        }

        .col-md-9 {
            background: #fff;
            padding: 3%;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .contact-form label {
            font-weight: 600;
        }

        .contact-form button {
            background: #25274d;
            color: #fff;
            font-weight: 600;
            width: 25%;
        }

        .contact-form button:focus {
            box-shadow: none;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Latest compiled and minified JavaScript -->
</head>

<body>
    <form action="submit_data.php" method="POST" enctype="multipart/form-data">
        <div class="container contact">
            <div class="row">
                <div class="col-md-3">
                    <div class="contact-info">
                        <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image" />
                        <h2>Contact Us</h2>
                        <h4>We would love to hear from you !</h4>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="contact-form">




                        <div class="form-group">
                            <label class="control-label col-sm-2" for="fname">First Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name[]" id="fname" placeholder="Enter First Name" name="fname">
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="control-label col-sm-2" for="lname">Last Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name[]" id="lname" placeholder="Enter Last Name" name="lname">
                            </div>
                        </div>





                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email[]" id="email" placeholder="Enter email" name="email">
                            </div>
                        </div>





                        <div id="div_id_stock_1_quantity" class="form-group">
                            <label for="file" class="control-label col-sm-2">Files:</label>
                            <div class="col-sm-10 ">
                                <input type ="file" placeholder="Enter file" class="form-control" name="file[]" multiple />
                            </div>
                        </div>






                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comment">Comment:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="comment[]" id="comment"></textarea>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>

    </form>
</body>