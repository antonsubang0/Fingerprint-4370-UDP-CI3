<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>/berkas/img/head.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/berkas/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/berkas/css/mycss.css">
    <?php if ($jstable==1) : ?>
      <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/berkas/css/dataTables.bootstrap4.min.css">
    <?php endif;?>
    <?php if ($jspicker==1) : ?>
      <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/berkas/css/jquery.datetimepicker.min.css">
    <?php endif;?>

    <title>Absensi CPI Subang</title>
  </head>
  <body>
      <div class="loading-cs">
          <div class="spinner-border loading-time" role="status" style="width: 5rem; height: 5rem;">
            <span class="sr-only">Loading...</span>
          </div>
      </div>
      <div class="notifikasi-cs" style="display: none;">
          <div class="alert" style="height: 50px;">
              A simple danger alert—check it out!
            </div>
      </div>
      <nav class="navbar navbar-expand shadow-sm navbar-light bg-white fixed-top border-bottom border-danger">
            <a href="<?= base_url();?>" class="text-dark"><h3 class="title-cs align-middle">Attandance</h3></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <h3 class="mx-auto px-3 border-left border-right title-cs"><u>CPI SUBANG</u></h3>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="<?= base_url('login/logout');?>">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row no-gutters" style="margin-top: 58px;">
            <div class="col-md-3 col-2 overflow-hidden shadow-sm" style="min-height: 90vh">
                <ul class="nav flex-column align-middle" id="accordionExample">
                    <li class="py-2 pl-3 border-bottom">
                        <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="text-cendol">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg><span class="ml-1 nav-a-cs">Data Employer</span>
                        </a>
                    </li>
                    <div class="collapse" id="collapseExample" data-parent="#accordionExample">
                        <ul class="list-unstyled">
                            <?php foreach ($daftarmesin as $row) : ?>
                                <?php if (! $statusMachine[$row->ipmesin]>0): ?>
                                    <li class="py-2 pl-4 pl-md-5 border-bottom">
                                        <a href="<?= base_url(); ?>home/datauser/<?= $row->id; ?>" class="text-body nav-ajs-cs">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                            <span class="ml-1 nav-a-cs"><?= $row->namamesin; ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>home/managementuser" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-person-lines-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                    </svg><span class="ml-1 nav-a-cs">Management User</span>
                                </a>
                            </li>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>home/managementdevisi" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                    </svg><span class="ml-1 nav-a-cs">Management Devisi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <li class="py-2 pl-3 border-bottom">
                        <a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" class="text-cendol">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-person-check-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            </svg><span class="ml-1 nav-a-cs">Attandance Employer</span>
                        </a>
                    </li>
                    <div class="collapse" id="collapseExample1" data-parent="#accordionExample">
                        <ul class="list-unstyled">
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>home/download/" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-arrow-left-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                    </svg><span class="ml-1 nav-a-cs">Download Attandance</span>
                                </a>
                            </li>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>report" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                      <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                      <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                                    </svg><span class="ml-1 nav-a-cs">Report</span>
                                </a>
                            </li>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>report/horizontal" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-file-earmark-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7.5 1.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4a.5.5 0 0 0-1 0v3.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 11.293V7.5z"/>
                                    </svg><span class="ml-1 nav-a-cs">Report Advance</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <li class="py-2 pl-3 border-bottom">
                        <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" class="text-cendol">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
                            </svg><span class="ml-1 nav-a-cs">Setting</span>
                        </a>
                    </li>
                    <div class="collapse" id="collapseExample2" data-parent="#accordionExample">
                        <ul class="list-unstyled">
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>setting" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-screwdriver" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
                                    </svg><span class="ml-1 nav-a-cs">Machine</span>
                                </a>
                            </li>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="<?= base_url(); ?>setting/kunciabsen" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg><span class="ml-1 nav-a-cs">Password</span>
                                </a>
                            </li>
                            <li class="py-2 pl-4 pl-md-5 border-bottom">
                                <a href="" class="text-body nav-ajs-cs">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 18 18" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                                      <path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                    </svg><span class="ml-1 nav-a-cs">Payroll</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>