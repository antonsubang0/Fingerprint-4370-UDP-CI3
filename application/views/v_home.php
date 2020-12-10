        <div class="col-md-9 col-10 pt-2 px-2 bg-light">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-12 position-absolute d-flex justify-content-center">
                            <?php if($this->session->flashdata('info')): ?>
                            <div class="alert alert-info homenotif-cs notif-time" role="alert">
                              <?= $this->session->flashdata('info'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Home</h4>
                            <small>Welcome to Attandance CPI Subang</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                        	<div id="carouselExampleControls shadow" style="width: 27rem;" class="carousel slide" data-ride="carousel">
							  	<div class="carousel-inner">
							    	<div class="carousel-item active">
								      	<img src="<?= base_url();?>/berkas/img/a.jpg" class="d-block w-100" alt="...">
								    </div>
								    <div class="carousel-item">
								      	<img src="<?= base_url();?>/berkas/img/b.jpg" class="d-block w-100" alt="...">
								    </div>
								    <div class="carousel-item">
								      	<img src="<?= base_url();?>/berkas/img/c.jpg" class="d-block w-100" alt="...">
								    </div>
							  	</div>
							  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							    	<span class="sr-only">Previous</span>
							  	</a>
							  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
							    	<span class="sr-only">Next</span>
							  </a>
							</div>     
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>