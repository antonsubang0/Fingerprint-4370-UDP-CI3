        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Import .dat from Flash Disk</h4>
                            <small>File .dat from fingerprint machine.</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                          <form method="post" action="<?= base_url(); ?>flashdisk/upload" enctype="multipart/form-data">
                              <input name="data" type="file" class="custom-file-input" id="validatedCustomFile" required>
                              <label class="custom-file-label" for="validatedCustomFile" id="labeldat">Choose file .dat...</label>
                              <?php if ($this->session->flashdata('notifinputfd')) : ?>
                                <div class="text-info"><?= $this->session->flashdata('notifinputfd'); ?></div>
                              <?php endif; ?>
                              <button type="submit" class="btn btn-primary mb-2 mt-2">Upload File</button>
                            </form>
                            <div class="mt-5 col">
                              <h4 class="text-danger text-center">Please dont rename the file from fingerprint machine. On default, filename is 1_attlog.dat (the number is define nomor machine).</h4>
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
