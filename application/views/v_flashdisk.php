        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Import .dat from Flash Disk</h4>
                            <small>File .dat from fingerprint machine.</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1 justify-content-center">
                        <div class="col-md-6 overflow-auto text-center" style="height: 50vh;">
                          <div class="custom-file mt-5 pb-5">
                            <form method="post" action="<?= base_url(); ?>flashdisk/upload" enctype="multipart/form-data">
                                <input name="data" type="file" class="custom-file-input" id="validatedCustomFile" required>
                                <label class="custom-file-label" for="validatedCustomFile" id="labeldat">Choose file .dat...</label>
                                <?php if ($this->session->flashdata('notifinputfd')) : ?>
                                  <div class="text-info"><?= $this->session->flashdata('notifinputfd'); ?></div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary mb-2 mt-2">Upload File</button>
                            </form>
                          </div>
                          <div class="mt-5 pt-3">
                            <h6 class="text-danger text-center">Please, Dont the rename a file from fingerprint machine. Because on default, the number of the filename is define nomor machine. Example : 1_attlog.dat, 2_attlog.dat dan 3_attlog.dat.</h6>
                          </div>
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
