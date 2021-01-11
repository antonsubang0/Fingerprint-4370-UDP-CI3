        <div class="col-md-9 col-10 pt-2 px-2 bg-light" id="app">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                        <div class="col-md-10 col-8">
                            <h4 class="mb-0">Summary</h4>
                            <small>Summary from Permission and Sick</small>
                        </div>
                        <div class="col-md-2 col-4 text-right">
                            <a href="<?= base_url(); ?>sakit/printringkasan" class="btn btn-primary" v-on:click='vuebtnprint'>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                              </svg>
                            </a>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table class="table table-sm table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th class="text-center">Paid Leave (No Used)</th>
                                        <th class="text-center">Sick</th>
                                        <th class="text-center">Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php foreach ($ijinsakit as $key => $value) : ?>
                                    <tr>
                                        <td><?= $key+1; ?></td>
                                        <td><?= $value->nama; ?></td>
                                        <td><?= $value->bnama; ?></td>
                                        <td class="text-center"><?= $value->sisa_cuti; ?></td>
                                        <td class="text-center"><?= $value->sakit; ?></td>
                                        <td class="text-center"><?= $value->ijin; ?></td>
                                    </tr>
                                	<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>
