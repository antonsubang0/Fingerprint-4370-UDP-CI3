<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>/assets/images/head.ico">
    <title>Absen Finger Subang</title>
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="bg-white d-flex"style="background-image: url('<?= base_url(); ?>/dist/css/icons/a.svg'); background-repeat: no-repeat; background-size: cover; min-height: 100vh; min-width: 100vw; align-items: center; justify-content: center;">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-lg">
              <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 align-middle text-center d-none d-md-block">
                        <h4 class="mt-4 mb-5">Management Absensi</h4>
                        <svg style="width: 60%; height: auto;" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 586.58 437"><defs><style>.cls-1{fill:#00a99d;}.cls-2{fill:#333;}.cls-3{fill:#fff;}.cls-4{fill:#7ac943;stroke:#000;stroke-miterlimit:10;}.cls-5{fill:#ccc;}.cls-6{fill:lime;}.cls-7{fill:#666;}.cls-8{fill:#c69c6d;}.cls-9{fill:#e6e6e6;}.cls-10{font-size:42.8px;font-family:News706BT-BoldC, News706 BT;font-weight:700;}.cls-11{fill:blue;}</style></defs><path class="cls-1" d="M130,298.63C156.49,263,213,267.41,274.48,272.16c82,6.35,105.26,16.19,174.32,81,62.33,58.51,60.73-37.29,126.87-21.11,34.55,8.45,100.55,101.52,107.47,118.12,54.73,131.24-41.3,202-41.3,202H366.71s-134.38,65.76-172.15,51.93c-36.77-13.46-73.18-19.58-78.68-68-9.75-85.9,12.73-99.78,10.67-207.15C125,346.13,111,324,130,298.63Z" transform="translate(-113.42 -269)"/><path class="cls-2" d="M155.75,332.05c2.74,2.35-7,0-8.46,35.38-.23,5.53-1,8.41-1.49,29.1-.7,30.6-1.05,45.9-1,49.64.39,26.08,2.12,24,2.49,51.36.3,21.68,0,41.65,0,41.65-.29,19.82-.78,24,1,32.53,0,0,.94,4.53,9,28.53,5.38,5.09,6.45,7.45,6,8.56-.92,2.13-8.37,1.43-13.43-2.86-4.52-3.82-6-9.56-8-20-5.27-28.1-5-34.23-5-34.23-2.68-165-1.87-158.85-2-159.77a116.66,116.66,0,0,1,0-25.68c1.65-15.38,5.4-21.65,7.47-24.54C146.54,335.83,153.57,330.18,155.75,332.05Z" transform="translate(-113.42 -269)"/><path class="cls-3" d="M156.74,598.53c4,5.13,6.26,9,8.46,9.13,4.57.2,14,.55,15.43,0,2.09-.8,13.43-1.14,42.29-5.71,8.92-1.41,13-2.28,17.41-2.85.6-.08,13.93-2.29,7.21-1.34-3.21.45,6.08-1.44,6.72-1.52,2.56-.29,4-.74,8.53-1.28,1.85-.23,6.44-.79,12.37-1.57,0,0,4.37-.58,8.64-1.17,11.45-1.6,33.63-5.4,38.62-6.25,9.86-1.67,55.34-9.3,64.68-11.41a76.07,76.07,0,0,0,7.53-1.9c1.38-.47,3.09-.47,5.41-.95,1.63-.34,2.46-1,3.48-1.14,4.1-.48,7.67-.9,10-2.86,1.87-1.59,2.52-3.92,3.49-9.13,2.47-13.37,2.48-18.26,2.48-18.26.07-21.71,2.94-10.84,2.49-74.17-.16-22.77-.5-20.78-1.49-69.62-.2-9.7-1.64-19.42-1-29.1.28-4.09.85-9.91-1-17.12-.92-3.6-2-8.56-5-10.84-2-1.52-6.2-2.17-10.44-1.71H364.72s-19.27-.1-52.25-1.71c-6.69-.33-16.91-.57-16.91-.57-.57,0,2.52-.37.11-.42-7.58-.15-20.77-.73-25.49-.73-8,0-16.84-1.14-20.4-1.14-14.42,0-7.16-.13-22.88,0-16.22.15-24.33.22-31.84,0-5.9-.16-14.27-.5-26.87-.57-4,0-6.25-1.44-9,0-2.26,1.21-7.81-1-10.45,19.4-1.79,13.83-2,20.55-2,20.55,1,29.2-2.77,12.41-2,66.19.21,13.88,1.31,13.58,2,45.64.92,42.65,0,20,.5,33.1.3,7.91-.27,29.68,0,41.65C147.75,579.26,155.33,596.7,156.74,598.53Z" transform="translate(-113.42 -269)"/><path class="cls-2" d="M169.18,344.61s18.41-.57,40.8,0c15.31.39,9.44-.53,57.22,0,16.65.18,30.62.33,49.75,1.14,14,.58,29.72,1.48,50.75,2.28,14.36.55,21.59.82,24.38.57a75.45,75.45,0,0,1,12.94,0l4.47.57a11.47,11.47,0,0,1,3.49,3.42,14.71,14.71,0,0,1,2,5.14,29.22,29.22,0,0,1,.49,9.13c-1,8.28,1.85,21.46,1.5,65.05-.14,17.48-.63,20.18-.5,37.66.09,11.57.45,12.17.5,24,.08,18.74-.67,17.21-1.5,37.66-.11,2.88-.71,5.7-1,8.56-.24,2.51-.37,4.2-1.49,5.71a7.47,7.47,0,0,1-3.49,2.28c-2.75,1.08-4.67.93-7.46,1.14-.39,0-2.58.4-7,1.14-19.91,3.37-29.86,5.14-29.86,5.14-25.94,4.62-47.76,8-47.76,8-19.15,3-33.74,4.89-44.28,6.28-15.46,2-31.15,3.93-45.77,5.7-24.57,3-24.28,2.8-26.87,3.43a121.06,121.06,0,0,1-19.9,2.85c-2,.1-1.81-.1-5,0s-4.28.32-5.47-.57c-1-.71-1.17-1.56-2-3.43-2-4.52-2.73-4-4.48-8a44.79,44.79,0,0,1-2.49-8s-.93-3.74-1.49-7.42c-1.64-10.76-.86-33.15-1-47.93-.06-5.83-.2-4.25-.5-15.41-.75-27.3-.08-42.33,0-67.33,0-9.82-.5-33.75-.5-43.37,0-5.87.14-6.43,0-10.27a46.18,46.18,0,0,1,0-8,37.27,37.27,0,0,1,1.49-6.84,45.65,45.65,0,0,1,2.49-6.28c1.25-2.72,1.68-3.16,2-3.42C165.69,343.53,169.18,344.61,169.18,344.61Z" transform="translate(-113.42 -269)"/><polygon class="cls-3" points="169.7 189.73 81.14 196 81.14 106.42 167.71 104.71 169.7 189.73"/><ellipse class="cls-4" cx="217.46" cy="112.12" rx="5.47" ry="6.28"/><ellipse class="cls-4" cx="202.54" cy="132.67" rx="5.47" ry="6.28"/><ellipse class="cls-4" cx="218.46" cy="153.21" rx="5.47" ry="6.28"/><ellipse class="cls-4" cx="203.04" cy="174.89" rx="5.47" ry="6.28"/><path class="cls-5" d="M358.75,489s4.47,13.12,19.4,13.12c12.9,0,19.9-14.83,19.9-14.83l-.5-91.3s-4-14.84-17.91-14.84c-12.45,0-18.54,6.41-21.39,15.41Z" transform="translate(-113.42 -269)"/><polygon class="cls-6" points="260.75 156.63 281.15 193.72 247.32 193.72 244.83 184.02 244.99 156.63 260.75 156.63"/><path class="cls-5" d="M184.61,493l26.66-2,79.81-6v7.55c0,5.4-3.62,9.89-8.32,10.32l-91.39,8.33c-3.65.33-6.76-3-6.76-7.17Z" transform="translate(-113.42 -269)"/><path class="cls-5" d="M184.61,517.29l26.66-2,79.81-6v7.55c0,5.4-3.62,9.89-8.32,10.32l-91.39,8.33c-3.65.33-6.76-3-6.76-7.16Z" transform="translate(-113.42 -269)"/><path class="cls-5" d="M185,541.45l26.62-2.67,79.67-8,.15,7.55c.1,5.4-3.43,10-8.12,10.54l-91.21,10.62c-3.64.42-6.82-2.8-6.9-7Z" transform="translate(-113.42 -269)"/><path class="cls-7" d="M389.09,453l8.86,15.2.1-72.83s-5-14.27-19.9-14.27c-16.42,0-19.9,15.41-19.9,15.41v29.1h16.91Z" transform="translate(-113.42 -269)"/><polygon points="555.58 355.42 525.94 355.2 519.47 352.35 490.12 348.36 454.79 341.51 445.83 339.23 437.38 342.08 427.43 347.22 415.98 359.77 405.53 376.89 402.05 383.16 528.21 383.45 555.58 355.42"/><polygon class="cls-3" points="425.44 339.23 419.46 339.23 407.03 345.5 396.58 351.78 388.62 361.48 381.65 372.89 379.16 383.16 402.05 383.16 415.98 360.91 429.66 346.06 437.38 342.08 425.44 339.23"/><path class="cls-8" d="M366.71,652.16V643s1.49-1.71,7-7.41,4.48-5.71,4.48-5.71l3-8.56V596.24l3-8.55,5-8.56,11-4L412,571.71l6.47-4,6.47-5.13,11.44-2.85h2.49l-12.94-12.56-9-8-6.47-10.27L404,517.5,400,505s-2-4-.5-12.56l1.5-8.56,5-6.84,6-4.57,6-1.14,5.48,2.28,8.45,8.56,8.46,13.13,11.94,12.55,14.43,13.12,8,6.85,10.45,4,14.43,7.41,5.47,4.57,8.46,10.84,10.45,13.12,10,14.27,4.48,11.41,7.46,13.7,5,4L541,608.75l-8.16-.52-12.44,6.27L510,620.78l-8,9.7-7,11.41-2.49,10.27Z" transform="translate(-113.42 -269)"/><path class="cls-9" d="M429.4,500.38s2.48-.57-1,1.71l-3.48,2.29h-4.48L415,502.09l-6-4-4.48-4.57L407,483.26l3.48-6.84,7.46-5.14,5.48,2.28,4,6.28,5,8,2,4.56V497Z" transform="translate(-113.42 -269)"/><text class="cls-10" transform="translate(142.87 419.85) scale(0.87 1)">Absensi CPI Subang</text><path class="cls-11" d="M282.87,458.44l-88.56,6.85.5-36.52s22.88,11.41,39.3-2.28c12.42-10.36,47.77,2.28,47.77,2.28Z" transform="translate(-113.42 -269)"/></svg>
                        <h6 class="mt-4">Powered by Antonius</h6>
                        <small class="mb-5">@ 2016-2022</small>
                    </div>
                    <div class="col-12 col-md-6 align-middle text-center">
                        <div class="card px-3 m-4 shadow position-relative">
                            <?php if($this->session->flashdata('info')): ?>
                                <div class="position-absolute" style="right: -20px; top: -15px;">
                                    <div class="alert alert-danger shadow" role="alert">
                                      <?= $this->session->flashdata('info'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>    
                            <div class="card-body">
                                <form method="post" action="<?= base_url();?>login/auth">
                                    <div class="row mb-4 mt-4">
                                        <div class="col">
                                            <h4>Login</h4>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="row mb-5 mt-4">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>   
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>