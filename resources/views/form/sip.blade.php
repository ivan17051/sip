<div class="row myform">
    <div class="col">
        <table class="table table-2-col">
            <tbody>
                <tr>
                    <td><label>Jenis Permohonan</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>PERMOHONAN BARU</option>
                            <option value="2">CABUT DAN PINDAH</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Praktik Ke-</label></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td><label>Nomor</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="" maxlength="5" value="ADAS2" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Nomor Rekom</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" value="81292" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Online</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Masuk Dinas</label></td>
                    <td>2 Januari 2022</td>
                </tr>
                <tr>
                    <td><label>Tanggal Verif & Cetak</label></td>
                    <td>23 Januari 2022</td>
                </tr>
                <tr>
                    <td><label>Jenis Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter</option>
                            <option value="2">Dokter Gigi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Spesialis</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter Anak</option>
                            <option value="2">Dokter Bedah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Sarana Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter Anak</option>
                            <option value="2">Dokter Bedah</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Alamat Praktik</label></td>
                    <td>Jl. Jemursari, Surabaya</td>
                </tr>
                <tr>
                    <td><label>Jadwal Praktik</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="" value="Senin-Jumat, 13:00-18:00" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Preview SIP</label></td>
                    <td><button class="btn btn-outline-primary btn-round btn-sm">preview <i class="material-icons">open_in_new</i></button></td>
                </tr>
                <tr>
                    <td><label>Histori SIP</label></td>
                    <td><button class="btn btn-outline-primary btn-round btn-sm" onclick="openHistoriSIP(1)">histori SIP <i class="material-icons">open_in_new</i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col" style="flex-grow:0;">
        <div class="float-right absolute myform-actions">
            <div data-state="0" class="anim slide">
                <button class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                    <i class="material-icons">edit_note</i>
                </button>
            </div>
            <div data-state="1" class="anim slide">
                <button class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0)">
                    <i class="material-icons">close</i>
                </button>
                <button class="btn btn-success btn-round btn-fab">
                    <i class="material-icons">save</i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya"><i
            class="material-icons">priority_high</i> TINDAKAN PERIZINAN</button>
</div>