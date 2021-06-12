<section id="basic-tabs-components">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                	<div class="col-sm-6">
                		<ul class="nav nav-tabs" role="tablist">
		                    <li class="nav-item">
		                        <a class="nav-link bg-warning active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
		                            <i class="bx bx-truck align-middle"></i>
		                            <span class="align-middle">Keluar Kota <span id="kirimluar">(0)</span></span>
		                        </a>
		                    </li>
		                    <li class="nav-item">
		                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
		                            <i class="bx bx-home align-middle"></i>
		                            <span class="align-middle">Dalam Kota <span id="kirimdalam">(0)</span></span>
		                        </a>
		                    </li>
		                </ul>
                	</div>
                	<div class="col-sm-6 kanan" style="padding-top: 12px;">
                		<strong class="card-title">Proses Pengiriman</strong>
                	</div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                        <table class="table" id="lkeluar">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">No Pengiriman</th>
                                    <th style="width: 25%;">Pengemudi</th>
                                    <th style="width: 25%;" class="tengah">Jumlah Kiriman</th>
                                    <th class="tengah">Lihat Daftar</th>
                                </tr>
                            </thead>
                            <tbody id="daftarkeluarkota"></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                        <table class="table" id="lmasuk" style="display: none;">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">No Pengiriman</th>
                                    <th style="width: 25%;">Kode Agen / Kurir</th>
                                    <th style="width: 25%;" class="tengah">Jumlah Kiriman</th>
                                    <th cla8000ss="tengah">Lihat Daftar</th>
                                </tr>
                            </thead>
                            <tbody id="daftardalamkota"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Keranjang -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailTitle">Memuat...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. Resi</th>
                            <th>Tgl. Pesan</th>
                            <th>Jenis Paket</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody id="listkeranjang"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
